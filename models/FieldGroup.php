<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Группа полей анкеты на выпуск сертификата
 *
 *
 */
class FieldGroup
{
    use ArrayConstructable;

    /**
     * Идентификатор поля
     *
     *
     * @var string
     */
    public string $id;

    /**
     * Человекопонятное название
     *
     *
     * @var string
     */
    public string $name;

}