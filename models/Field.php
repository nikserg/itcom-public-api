<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Поле формы анкеты заявки на сертификат
 *
 *
 */
class Field
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

    /**
     * Поле обязательно
     *
     *
     * @var bool
     */
    public bool $required;

    /**
     * Тип поля
     *
     *
     * @var string
     */
    public string $type;

    /**
     * Значение поля (если заполнено)
     *
     *
     * @var mixed
     */
    public mixed $value;
}