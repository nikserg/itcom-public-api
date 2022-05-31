<?php

namespace nikserg\ItcomPublicApi\models\request;

/**
 * Криптопровайдеры
 */
class CryptoProvider
{
    public const CRYPTO_PRO_2012 = 'CRYPTO_PRO_2012';
    public const RUTOKEN_GOST_2012 = 'RUTOKEN_GOST_2012';
    public const VIPNET_2012 = 'VIPNET_2012';
    public const ESMART_2012 = 'ESMART_2012';
    public const JA_CARTA_2012 = 'JA_CARTA_2012';

    /**
     * Человекопонятные названия
     */
    public const NAMES = [
        self::CRYPTO_PRO_2012 => 'Крипто ПРО ГОСТ 2012',
        self::RUTOKEN_GOST_2012 => 'Рутокен ГОСТ 2012',
        self::VIPNET_2012 => 'VipNet 2012',
        self::ESMART_2012 => 'ESMART ГОСТ',
        self::JA_CARTA_2012 => 'JaCarta 2 ГОСТ 2012',
    ];
}