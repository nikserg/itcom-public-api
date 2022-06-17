<?php

namespace nikserg\ItcomPublicApi;

use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;
use nikserg\ItcomPublicApi\models\response\RequestData;

/**
 * Авторизация через индивидуальный токен заявки вида 1_299d37000a26677fa3049816558a816eind, где
 * 1 - ID заявки, 299d37000a26677fa3049816558a816eind - токен доступа.
 *
 */
class IndividualRequestClient extends BaseClient
{

    private int $requestId;

    /**
     * ID заявки, для которой был создан клиент
     *
     *
     * @return int
     */
    public function getRequestId(): int
    {
        return $this->requestId;
    }

    /**
     * Новый клиент из токена вида 1_299d37000a26677fa3049816558a816eind
     *
     *
     * @param string $token
     * @param string $host
     * @return \nikserg\ItcomPublicApi\IndividualRequestClient
     */
    public static function fromCombinedToken(string $token, string $host = self::HOST_DEV): IndividualRequestClient
    {
        return new IndividualRequestClient(self::getIdFromCombinedToken($token),
            self::getTokenFromCombinedToken($token), $host);
    }

    /**
     * Новый клиент из заявки на сертификат
     *
     *
     * @param \nikserg\ItcomPublicApi\models\response\Certificate $certificate
     * @param string                                              $host
     * @return \nikserg\ItcomPublicApi\IndividualRequestClient
     */
    public static function fromCertificate(
        Certificate $certificate,
        string $host = self::HOST_DEV
    ): IndividualRequestClient {
        return new IndividualRequestClient($certificate->id, $certificate->getToken(), $host);
    }

    /**
     * @param int    $id ID заявки
     * @param string $requestToken Токен доступа заявки
     * @param string $host
     */
    public function __construct(int $id, string $requestToken, string $host = self::HOST_DEV)
    {
        $this->requestId = $id;
        $bearerToken = $id . '_' . $requestToken;
        parent::__construct($bearerToken, $host);
    }

    /**
     * Извлечь ID заявки из строки вида 1_299d37000a26677fa3049816558a816eind
     *
     * @param string $combinedToken
     * @return int
     */
    protected static function getIdFromCombinedToken(string $combinedToken): int
    {
        preg_match('/(\d+)_(.+)/', $combinedToken, $matches);

        return $matches[1]; //ID заявки
    }

    /**
     * Извлечь токен доступа из строки вида 1_299d37000a26677fa3049816558a816eind
     *
     * @param string $combinedToken
     * @return string
     */
    protected static function getTokenFromCombinedToken(string $combinedToken): string
    {
        preg_match('/(\d+)_(.+)/', $combinedToken, $matches);

        return $matches[2]; //Токен доступа заявки
    }

    /**
     * Для доступа по индивидуальному токену доступно только редактирование текущей заявки
     *
     * @see \nikserg\ItcomPublicApi\BaseClient::baseCreateOrUpdate()
     */
    public function createOrUpdate(
        array $platforms = [Platform::EPGU],
        ?string $name = null,
        string $legalForm = LegalForm::LEGAL,
        string $target = Target::CONFIDANT,
        string $cryptoProvider = CryptoProvider::CRYPTO_PRO_2012,
        bool $embeddedCp = false,
        bool $isForeigner = false,
        bool $isMep = false
    ): Certificate {
        return parent::baseCreateOrUpdate($platforms, $this->requestId, $name, $legalForm, $target, $cryptoProvider,
            $embeddedCp,
            $isForeigner, $isMep);
    }

    /**
     * По индивидуальной ссылке доступен просмотр только одной заявки
     *
     *
     * @see \nikserg\ItcomPublicApi\BaseClient::baseView()
     */
    public function view(): Certificate
    {
        return parent::baseView($this->getRequestId());
    }

    /**
     * По индивидуальной ссылке доступно заполнение только одной заявки
     *
     *
     * @see \nikserg\ItcomPublicApi\BaseClient::baseView()
     */
    public function fill(array $fields): void
    {
        parent::baseFill($this->getRequestId(), $fields);
    }

    /**
     * Скачивание бланков только по своей заявке
     *
     *
     * @see \nikserg\ItcomPublicApi\BaseClient::baseBlank()
     */
    public function blank(string $blankId, string $format = 'pdf'): string
    {
        return parent::baseBlank($this->getRequestId(), $blankId, $format);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseUpload()
     */
    public function upload(string $documentId, string $binaryDocumentContent): void
    {
        parent::baseUpload($this->getRequestId(), $documentId, $binaryDocumentContent);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseDocument()
     */
    public function document(string $documentId): string
    {
        return parent::baseDocument($this->requestId, $documentId);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseRequestData()
     */
    public function requestData(): RequestData
    {
        return parent::baseRequestData($this->requestId);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseRequest()
     */
    public function request(string $content, string $containerInfo): void
    {
        parent::baseRequest($this->requestId, $content, $containerInfo);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseRevert()
     */
    public function revert(): void
    {
        parent::baseRevert($this->requestId);
    }
}
