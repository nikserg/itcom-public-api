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
     * Для пользователя доступно как редактирование своих, так и создание новых заявок
     *
     *
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
     * Для пользователя доступно заполнение любой из своих заявок
     *
     *
     * @see \nikserg\ItcomPublicApi\BaseClient::baseFill()
     */
    public function fill(int $id, array $fields): void
    {
        parent::baseFill($id, $fields);
    }

    /**
     * Для пользователя доступен просмотр любой из своих заявок
     *
     * @see \nikserg\ItcomPublicApi\BaseClient::baseView()
     */
    public function view(int $id): Certificate
    {
        return parent::baseView($id);
    }
}
