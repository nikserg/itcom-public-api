<?php

namespace nikserg\ItcomPublicApi;

use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;

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
        return new Certificate($this->guzzleClient->post(self::URI_CREATE_OR_UPDATE, [
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
        ]));

    }

}