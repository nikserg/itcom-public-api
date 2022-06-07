<?php

namespace nikserg\ItcomPublicApi;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\InvalidArgumentException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use nikserg\ItcomPublicApi\exceptions\InvalidJsonException;
use nikserg\ItcomPublicApi\exceptions\NotFoundException;
use nikserg\ItcomPublicApi\exceptions\PublicApiException;
use nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestException;
use nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestValidationException;
use nikserg\ItcomPublicApi\exceptions\WrongCodeException;
use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;
use nikserg\ItcomPublicApi\models\response\Code;
use Psr\Http\Message\ResponseInterface;

/**
 * API для работы с системой Айтиком
 *
 * Документация:
 *
 * @see https://app.swaggerhub.com/apis/nikserg/crm-certificate-api/1.0.16
 */
class Client
{
    //
    // Хосты систем
    //
    public const HOST_DEV = 'https://dev.uc-itcom.ru'; //Тестовая
    public const HOST_PROD = 'https://crm.uc-itcom.ru'; //Боевая


    //
    // Адреса внутри системы
    //
    private const URI_CREATE_OR_UPDATE = 'certificate/createOrUpdate';
    private const URI_FILL = 'certificate/fill';
    private const URI_VIEW = 'certificate/view';

    private \GuzzleHttp\Client $guzzleClient;


    public function __construct(string $bearerToken, string $host = self::HOST_DEV)
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
            'base_uri' => $host . '/app/index.php/publicApi/',
            'headers'  => [
                'Authorization' => 'Bearer ' . $bearerToken,
            ],
        ]);
    }

    /**
     * Создать или изменить заявку на выпуск сертификата
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
     * @return \nikserg\ItcomPublicApi\models\response\Certificate
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createOrUpdate(
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
     * Получить данные о заявке на сертификат
     *
     *
     * @param int $id
     * @return \nikserg\ItcomPublicApi\models\response\Certificate
     * @throws \nikserg\ItcomPublicApi\exceptions\NotFoundException|\GuzzleHttp\Exception\GuzzleException
     */
    public function view(int $id): Certificate
    {
        try {
            $decodedAnswer = self::jsonDecode((string)($this->guzzleClient->get(self::URI_VIEW . '?id=' . $id)->getBody()),
                true);
            return new Certificate($decodedAnswer);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                throw new NotFoundException($id);
            }
            throw $exception;
        }
    }

    /**
     * Заполнить анкету заявки на сертификат
     *
     * @param int                                                       $id
     * @param \nikserg\ItcomPublicApi\models\request\FillRequestField[] $fields
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \nikserg\ItcomPublicApi\exceptions\InvalidJsonException
     * @throws \nikserg\ItcomPublicApi\exceptions\NotFoundException
     * @throws \nikserg\ItcomPublicApi\exceptions\PublicApiException
     * @throws \nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestException
     * @throws \nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestValidationException
     * @throws \nikserg\ItcomPublicApi\exceptions\WrongCodeException
     */
    public function fill(int $id, array $fields): void
    {
        try {
            $response = $this->checkError($this->guzzleClient->post(self::URI_FILL . '?id=' . $id,
                [
                    'json'        => $fields,
                    'http_errors' => false,
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
     * @param string $json
     * @param bool   $asAssoc
     * @return array|bool|float|int|object|string|null
     * @throws \nikserg\ItcomPublicApi\exceptions\InvalidJsonException
     */
    public static function jsonDecode(string $json, bool $asAssoc = false)
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
     * @throws \nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestException
     * @throws \nikserg\ItcomPublicApi\exceptions\PublicApiMalformedRequestValidationException
     * @throws \nikserg\ItcomPublicApi\exceptions\PublicApiException
     */
    private function checkError(ResponseInterface $response): ResponseInterface
    {
        $body = (string)($response->getBody());
        $json = self::jsonDecode($body, true);
        if (isset($json['error'])) {
            $errorClass = PublicApiException::class;
            switch ($json['error']['type']) {
                case 'PublicApiMalformedRequestException':
                    $errorClass = PublicApiMalformedRequestException::class;
                    break;
                case 'PublicApiMalformedRequestValidationException':
                    $errorClass = PublicApiMalformedRequestValidationException::class;
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
     * @param \nikserg\ItcomPublicApi\models\response\Code $code
     * @return void
     * @throws \nikserg\ItcomPublicApi\exceptions\WrongCodeException
     */
    protected function checkResponseCode(Code $code): void
    {
        if (!$code->isSuccess()) {
            throw new WrongCodeException($code);
        }
    }

}
