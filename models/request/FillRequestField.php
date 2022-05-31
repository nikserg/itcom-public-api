<?php

namespace nikserg\ItcomPublicApi\models\request;

/**
 * Поле заявки на сертификат, которое используется при вызове метода fill()
 */
class FillRequestField
{
    /**
     * Имя поля
     *
     *
     * @var string
     */
    public string $id;

    /**
     * Значение поля
     *
     *
     * @var mixed
     */
    public mixed $value;

    /**
     * @param string $id Название поля
     * @param mixed  $value Значение поля
     */
    public function __construct(string $id, mixed $value)
    {
        $this->id = $id;
        $this->value = $value;
    }
}