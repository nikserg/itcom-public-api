<?php

namespace nikserg\ItcomPublicApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\InvalidArgumentException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Utils;
use nikserg\ItcomPublicApi\exceptions\InvalidJsonException;
use nikserg\ItcomPublicApi\exceptions\NotFoundException;
use nikserg\ItcomPublicApi\exceptions\PublicApiBearerException;
use nikserg\ItcomPublicApi\exceptions\PublicApiException;
use nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestException;
use nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestValidationException;
use nikserg\ItcomPublicApi\exceptions\PublicApiNoReqFileException;
use nikserg\ItcomPublicApi\exceptions\PublicApiNotFoundCertificateException;
use nikserg\ItcomPublicApi\exceptions\PublicApiNotFoundException;
use nikserg\ItcomPublicApi\exceptions\PublicApiRemoteException;
use nikserg\ItcomPublicApi\exceptions\WrongCodeException;
use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\FillRequestField;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;
use nikserg\ItcomPublicApi\models\response\Code;
use nikserg\ItcomPublicApi\models\response\Crt;
use nikserg\ItcomPublicApi\models\response\RequestData;
use Psr\Http\Message\ResponseInterface;

/**
 * API для работы с системой Айтиком.
 *
 * Авторизация одним из двух способов:
 * - Bearer-токен пользователя, который дает доступ ко всем заявкам пользователя. Например, "123" для суперпользователя
 * на тестовом сервере.
 * - Индивидуальный токен заявки, соединенный ее ID, дает доступ только к этой заявке. Например
 * "1_299d37000a26677fa3049816558a816eind", где 1 - ID заявки, 299d37000a26677fa3049816558a816eind - токен доступа.
 *
 * Документация:
 *
 * @see https://app.swaggerhub.com/apis/nikserg/crm-certificate-api
 */
abstract class BaseClient
{
    //
    // Хосты систем
    //
    public const HOST_DEV = 'https://dev.uc-itcom.ru/app/index.php/publicApi/'; //Тестовая
    public const HOST_PROD = 'https://crm.uc-itcom.ru/app/index.php/publicApi/'; //Боевая


    //
    // Адреса внутри системы
    //
    private const URI_CREATE_OR_UPDATE = 'certificate/createOrUpdate'; //Создать или изменить заявку на выпуск сертификата
    private const URI_FILL = 'certificate/fill'; //Заполнить анкетные данные
    private const URI_VIEW = 'certificate/view'; //Посмотреть данные о сертификате
    private const URI_BLANK = 'certificate/blank'; //Скачать бланки для выпуска сертификата
    private const URI_UPLOAD = 'certificate/upload'; //Загрузить сканы документов
    private const URI_DOCUMENT = 'certificate/document'; //Скачать ранее загруженный скан документа
    private const URI_REQUEST_DATA = 'certificate/requestData'; //Данные для формирования req-файла
    private const URI_REQUEST = 'certificate/request'; //Загрузить req-файл
    private const URI_REVERT = 'certificate/revert'; //Откатить заявку
    private const URI_REQUEST_VERIFICATION = 'certificate/requestVerification'; //Запросить проверку документов
    private const URI_GET_CRT = 'certificate/certificate'; //Скачать crt-файл выпущенного сертификата

    protected Client $guzzleClient;


    /**
     * @param string $bearerToken Токен доступа пользователя системы
     * @param string $host Адрес системы
     */
    public function __construct(string $bearerToken, string $host = self::HOST_DEV)
    {
        $this->guzzleClient = new Client([
            //'debug'    => 1,
            'base_uri'    => $host,
            'headers'     => [
                'Authorization' => 'Bearer ' . $bearerToken,
            ],
            'http_errors' => false,
        ]);
    }


    /**
     * Загрузка скана документа
     *
     *
     * @param int    $id ID заявки
     * @param string $documentId ID документа
     * @param string $binaryDocumentContent Содержимое файла
     * @param string $fileExtension Расширение файла
     * @return void
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws WrongCodeException
     * @see \nikserg\ItcomPublicApi\models\Document
     */
    protected function baseUpload(
        int $id,
        string $documentId,
        string $binaryDocumentContent,
        string $fileExtension
    ): void {
        try {
            $response = $this->checkError($this->guzzleClient->request('POST', self::URI_UPLOAD, [
                'query'     => [
                    'id'       => $id,
                    'document' => $documentId,
                ],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => $binaryDocumentContent,
                        'filename' => $documentId . '.' . $fileExtension,
                    ],
                ],
            ]));
            $responseContent = (string)($response->getBody());
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        } catch (ServerException $exception) {
            throw new ServerException((string)($exception->getResponse()->getBody()), $exception->getRequest(),
                $exception->getResponse());
        }
        $decodedResponseContent = self::jsonDecode($responseContent, true);
        $responseCode = new Code($decodedResponseContent);
        $this->checkResponseCode($responseCode);
    }

    /**
     * Скачать бланк сертификата
     *
     *
     * @param int          $id
     * @param array|string $blankId ID бланка или массив с этими ID
     * @param string       $format pdf/html
     * @return string
     * @throws GuzzleException
     * @see \nikserg\ItcomPublicApi\models\request\Blank
     */
    protected function baseBlank(int $id, array|string $blankId, string $format = 'pdf'): string
    {
        if (is_array($blankId)) {
            $blankId = implode(',', $blankId);
        }
        return $this->guzzleClient->get(self::URI_BLANK, [
            'query' => [
                'id'       => $id,
                'document' => $blankId,
                'format'   => $format,
            ],
        ])->getBody()->getContents();
    }

    /**
     * Скачать crt-файл выпущенного сертификата
     *
     * @param int $id
     * @return Crt
     * @throws InvalidJsonException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws GuzzleException
     */
    protected function baseCrt(int $id): Crt
    {
        $json = (string)($this->checkError($this->guzzleClient->get(self::URI_GET_CRT, [
            'query' => [
                'id' => $id,
            ],
        ]))->getBody());

        $decoded = self::jsonDecode($json, true);
        return new Crt($decoded);
    }

    /**
     * Создать или изменить заявку на выпуск сертификата.
     *
     *
     * @param array       $platforms
     * @param int|null    $id
     * @param string|null $name
     * @param string      $legalForm
     * @param string      $target
     * @param string      $cryptoProvider
     * @param bool        $embeddedCp
     * @param bool        $isForeigner
     * @param bool        $isMep
     * @return Certificate
     * @throws GuzzleException
     * @throws InvalidJsonException
     */
    protected function baseCreateOrUpdate(
        array $platforms = [Platform::EPGU],
        ?int $id = null,
        ?string $name = null,
        string $legalForm = LegalForm::LEGAL,
        string $target = Target::CONFIDANT,
        string $cryptoProvider = CryptoProvider::CRYPTO_PRO_2012,
        bool $embeddedCp = false,
        bool $isForeigner = false,
        bool $isMep = false
    ): Certificate {
        return new Certificate(self::jsonDecode((string)($this->guzzleClient->post(self::URI_CREATE_OR_UPDATE, [
            'json' => [
                'platforms'      => $platforms,
                'id'             => $id,
                'name'           => $name,
                'legalForm'      => $legalForm,
                'target'         => $target,
                'embededCP'      => $embeddedCp,
                'cryptoProvider' => $cryptoProvider,
                'isMep'          => $isMep,
                'isForeigner'    => $isForeigner,
                'isNewProcess'   => true,
            ],
        ])->getBody()), true));

    }

    /**
     * Скачать ранее загруженный документ
     *
     *
     * @param int    $id
     * @param string $documentId
     * @return string
     * @throws GuzzleException
     * @throws NotFoundException
     */
    protected function baseDocument(int $id, string $documentId): string
    {
        try {
            return (string)($this->guzzleClient->get(self::URI_DOCUMENT, [
                'query' => [
                    'id'       => $id,
                    'document' => $documentId,
                ],
            ])->getBody());

        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
    }

    /**
     * Получить данные о заявке на сертификат
     *
     *
     * @param int $id
     * @return Certificate
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     */
    protected function baseView(int $id): Certificate
    {
        try {
            $decodedAnswer = self::jsonDecode((string)($this->checkError($this->guzzleClient->get(self::URI_VIEW, [
                'query' => [
                    'id' => $id,
                ],
            ]))->getBody()),
                true);

            return new Certificate($decodedAnswer);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        } catch (PublicApiNotFoundCertificateException) {
            throw new NotFoundException($id);
        }
    }

    /**
     * Заполнить анкету заявки на сертификат
     *
     * @param int                                                       $id
     * @param FillRequestField[] $fields
     * @return void
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws WrongCodeException
     */
    protected function baseFill(int $id, array $fields): void
    {
        try {
            $response = $this->checkError($this->guzzleClient->post(self::URI_FILL,
                [
                    'query' => [
                        'id' => $id,
                    ],
                    'json'  => $fields,
                ]));
            $responseContent = (string)($response->getBody());
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
        $decodedResponseContent = self::jsonDecode($responseContent, true);
        $responseCode = new Code($decodedResponseContent);
        $this->checkResponseCode($responseCode);
    }

    /**
     * Откатить заявку
     *
     *
     * @param int $id
     * @return void
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws WrongCodeException
     */
    protected function baseRevert(int $id): void
    {
        try {
            $response = $this->checkError($this->guzzleClient->get(self::URI_REVERT,
                [
                    'query' => [
                        'id' => $id,
                    ],
                ]));
            $responseContent = (string)($response->getBody());
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
        $decodedResponseContent = self::jsonDecode($responseContent, true);
        $responseCode = new Code($decodedResponseContent);
        $this->checkResponseCode($responseCode);
    }

    /**
     * Отправка req-файла
     *
     *
     * @param int    $id
     * @param string $content
     * @param string $containerInfo
     * @return void
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws WrongCodeException
     */
    protected function baseRequest(int $id, string $content, string $containerInfo): void
    {
        try {
            $response = $this->checkError($this->guzzleClient->post(self::URI_REQUEST,
                [
                    'query' => [
                        'id' => $id,
                    ],
                    'json'  => [
                        'content'       => $content,
                        'containerInfo' => $containerInfo,
                    ],
                ]));
            $responseContent = (string)($response->getBody());
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
        $decodedResponseContent = self::jsonDecode($responseContent, true);
        $responseCode = new Code($decodedResponseContent);
        $this->checkResponseCode($responseCode);
    }

    /**
     * Запросить проверку документов
     *
     *
     * @param int $id
     * @return void
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     * @throws PublicApiException
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws WrongCodeException
     */
    protected function baseRequestVerification(int $id): void
    {
        try {
            $response = $this->checkError($this->guzzleClient->post(self::URI_REQUEST_VERIFICATION,
                [
                    'query' => [
                        'id' => $id,
                    ],
                ]));
            $responseContent = (string)($response->getBody());
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
        $decodedResponseContent = self::jsonDecode($responseContent, true);
        $responseCode = new Code($decodedResponseContent);
        $this->checkResponseCode($responseCode);
    }

    /**
     * Получить данные для формирования req-файла
     *
     *
     * @param int $id
     * @return RequestData
     * @throws GuzzleException
     * @throws InvalidJsonException
     * @throws NotFoundException
     */
    protected function baseRequestData(int $id): RequestData
    {
        try {
            $response = $this->checkError($this->guzzleClient->get(self::URI_REQUEST_DATA, [
                'query' => [
                    'id' => $id,
                ],
            ]));
            $decodedAnswer = self::jsonDecode((string)($response->getBody()),
                true);

            return new RequestData($decodedAnswer);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
    }


    /**
     * @param string $json
     * @param bool   $asAssoc
     * @return array|bool|float|int|object|string|null
     * @throws InvalidJsonException
     */
    protected static function jsonDecode(string $json, bool $asAssoc = false)
    {
        if (!$json) {
            throw new InvalidJsonException('Получена пустая строка, хотя ожидался json');
        }
        try {
            return Utils::jsonDecode($json, $asAssoc);
        } catch (InvalidArgumentException) {
            throw new InvalidJsonException($json);
        }
    }

    /**
     * Проверить json-ответ от API и выбросить исключения, если в нем есть ошибочный код
     *
     *
     * @throws PublicApiMalformedRequestException
     * @throws PublicApiMalformedRequestValidationException
     * @throws PublicApiException
     * @throws InvalidJsonException
     */
    protected function checkError(ResponseInterface $response): ResponseInterface
    {
        $body = (string)($response->getBody());
        $json = self::jsonDecode($body, true);
        if (isset($json['error'])) {
            $errorClass = PublicApiException::class;
            switch ($json['error']['type']) {
                case 'CustomerFormNoReqFileException':
                    $errorClass = PublicApiNoReqFileException::class;
                    break;
                case 'NotFoundException':
                    $errorClass = PublicApiNotFoundException::class;
                    break;
                case 'PublicApiMalformedRequestException':
                    $errorClass = PublicApiMalformedRequestException::class;
                    break;
                case 'PublicApiMalformedRequestValidationException':
                    $errorClass = PublicApiMalformedRequestValidationException::class;
                    break;
                case 'PublicApiBearerException':
                    $errorClass = PublicApiBearerException::class;
                    break;
                case 'CrmCoreClients\Certificates\Exceptions\NoCertificateRemoteException':
                    $errorClass = PublicApiNotFoundCertificateException::class;
                    break;
                case 'CrmCoreClients\Certificates\Exceptions\RemoteException':
                    $errorClass = PublicApiRemoteException::class;
                    break;
            }
            throw new $errorClass($json['error']);
        }

        return $response;
    }

    /**
     * Проверить возвращенный код и выбросить исключение, если он не успешный
     *
     *
     * @param Code $code
     * @return void
     * @throws WrongCodeException
     */
    protected function checkResponseCode(Code $code): void
    {
        if (!$code->isSuccess()) {
            throw new WrongCodeException($code);
        }
    }
}
