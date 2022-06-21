<?php

namespace nikserg\ItcomPublicApi\models\response;

use nikserg\ItcomPublicApi\models\Document;
use nikserg\ItcomPublicApi\models\Field;
use nikserg\ItcomPublicApi\models\Response;
use nikserg\ItcomPublicApi\models\Status;

/**
 * Данные о выпущенном сертификате
 */
class Crt extends Response
{
    /**
     * Имя контейнера
     *
     *
     * @var string
     */
    public string $containerName;
    /**
     * Содержимое crt-файла
     *
     *
     * @var string
     */
    public string $content;
}
