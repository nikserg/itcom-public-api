<?php

namespace nikserg\ItcomPublicApi\models\request;

/**
 * Типы бланков
 */
class Blank
{
    public const UNION = 'union'; //Заявление на выпуск сертификата
    public const CERT_REQUEST = 'cert_request'; //Запрос на выдачу сертификата ключа проверки электронной подписи (можно скачать, если файл запроса уже есть)
    public const CERT_BLANK = 'certificateblank'; //Бланк сертификата (можно скачать только если сертификат уже выпущен)
    public const REVOCATION = 'revocationcertificateblank'; //Бланк отзыва сертификата (можно скачать только если сертификат уже выпущен)
}
