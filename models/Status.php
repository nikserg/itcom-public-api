<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Статус заявки на выпуск сертификата
 */
class Status
{
    use ArrayConstrictable {
        __construct as protected parent_construct;
    }


    /**
     * Числовой код статуса
     *
     *
     * @var int
     */
    public int $code;

    /**
     * Человекопонятное название статуса
     *
     *
     * @var string
     */
    public string $name;

    /**
     *
     * Описание статуса
     *
     *
     * @var string
     */
    public string $description;

    /**
     * Причина отклонения заявки
     *
     *
     * @var string
     */
    public string $reason;

    public function __construct(array $array)
    {
        $array['code'] = intval($array['code']);
        $this->parent_construct($array);
    }
}