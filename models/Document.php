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

    public const ID_UNION = 'union'; //Заявление на выпуск сертификата
    public const ID_UNION_OSNOVANIE = 'unionosnovanie'; //Заявление на изготовление сертификата ключа проверки электронной подписи полученное по api Основание
    public const ID_REVOCATION_BLANK = 'revocationcertificateblank'; // Бланк отзыва сертификата
    public const ID_CERT_REQUEST = 'cert_request'; //Запрос на выдачу сертификата ключа проверки электронной подписи
    public const ID_CERTIFICATE_BLANK = 'certificateblank'; //Бланк выпущенного сертификата
    public const ID_SNILS = 'snils'; //Страховое свидетельство государственного пенсионного страхования (СНИЛС) владельца сертификата
    public const ID_PASSPORT_PHONO = 'passportphoto'; //Страница паспорта с фото
    public const ID_PASSPORT_REGISTRATION = 'passportregistration'; //Страница паспорта с регистрацией
    public const ID_DISTINCT_CONFIDENCE = 'distinctConfidence'; //Доверенность от руководителя по выписке о предоставлении прав действовать от имени ЮЛ
    public const ID_ADDITIONAL = 'additional'; //Прочие (при необходимости)
    public const ID_OSNOVANIE_ZIP = 'osnovaniezip'; //Архив документов для api Основание
    public const ID_OSNOVANIE_ZIP_SIGN = 'osnovaniezipsign'; //Открепленная подпись архива документов для api Основание
    public const ID_SAFETY_POLICY = 'safetypolicy'; //Памятка по безопасности

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
