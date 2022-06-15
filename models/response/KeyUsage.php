<?php

namespace nikserg\ItcomPublicApi\models\response;
use nikserg\ItcomPublicApi\models\ArrayConstructable;

/**
 * Параметры использования ключа
 *
 *
 */
class KeyUsage
{
    use ArrayConstructable;

    public bool $digitalSignature;
    public bool $nonRepudiation;
    public bool $keyEncipherment;
    public bool $dataEncipherment;
    public bool $keyAgreement;
    public bool $keyCertSign;
    public bool $cRLSign;
    public bool $encipherOnly;
    public bool $decipherOnly;
}
