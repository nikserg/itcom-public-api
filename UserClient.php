<?php

namespace nikserg\ItcomPublicApi;

use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;

/**
 * Авторизация через bearer-токен пользователя
 *
 */
class UserClient extends BaseClient
{


    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseCreateOrUpdate()
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
        return parent::baseCreateOrUpdate($platforms, $id, $name, $legalForm, $target, $cryptoProvider, $embeddedCp,
            $isForeigner, $isMep);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseFill()
     */
    public function fill(int $id, array $fields): void
    {
        parent::baseFill($id, $fields);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseView()
     */
    public function view(int $id): Certificate
    {
        return parent::baseView($id);
    }

    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseBlank()
     */
    public function blank(int $id, string $blankId, string $format = 'pdf'): string
    {
        return parent::baseBlank($id, $blankId, $format);
    }
    /**
     * @see \nikserg\ItcomPublicApi\BaseClient::baseUpload()
     */
    public function upload(int $id, string $documentId, string $binaryDocumentContent): void
    {
        parent::baseUpload($id, $documentId, $binaryDocumentContent);
    }
}
