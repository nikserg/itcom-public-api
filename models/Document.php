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

    public const ID_ADDITIONAL = 'additional'; //Прочие (при необходимости)
    public const ID_UNION = 'union'; //Заявление на выпуск сертификата
    public const ID_CERT_REQUEST = 'cert_request'; //Запрос на выдачу сертификата ключа проверки электронной подписи

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
