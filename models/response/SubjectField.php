<?php

namespace nikserg\ItcomPublicApi\models\response;
use nikserg\ItcomPublicApi\models\ArrayConstructable;

/**
 * Данные ОИДа наполнения сертификата
 *
 *
 */
class SubjectField
{
    use ArrayConstructable;

    public string $oid;
    public string $value;
}
