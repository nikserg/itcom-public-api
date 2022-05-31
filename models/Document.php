<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Информация о загруженном документе
 *
 *
 */
class Document
{
    use ArrayConstructable;
    /**
     * Идентификатор документа
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
     * Загружен ли документ
     *
     *
     * @var bool
     */
    public bool $uploaded;

    /**
     * Описание
     *
     *
     * @var string
     */
    public string $description;
}