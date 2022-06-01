<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Статус заявки на выпуск сертификата
 */
class Status
{
    use ArrayConstructable {
        __construct as protected parent_construct;
    }
    //
    // Статус заполненности
    //
    const CODE_INIT = 0; //Не заполнено
    const CODE_NEED_AUTO_CHECK = 2; //Требуется автоматическая проверка СМЭВ
    const CODE_CALLBACK = 5; // Требуется связаться с клиентом
    const CODE_NEED_PREREQUEST = 7; //Нужно сформировать запрос на выпуск
    const CODE_FORMFILLED = 10; //Форма заполнена, документы не прикреплены
    const CODE_CERTIFICATE_REQUEST_DECLINED = 19; //Запрос сертификата отклонен
    const CODE_REFILL = 20; //Необходимо повторно заполнить форму
    const CODE_DOCUMENTSLOADED = 30; //Заполнено, не проверено
    const CODE_NEED_MANUAL_START = 35; //Требуется одобрение выпуска

    const CODE_NEED_UNION_AND_PHOTO_RELOAD = 36; // Ошибка в заявление или фотографии на выпуск
    const CODE_NEED_UNION = 37; //Требуется загрузка заявления на выпуск сертификата
    const CODE_NEED_UNION_RELOAD = 38; //Ошибка в заявлении
    const CODE_UNION_LOADED = 39; //Заявление загружено

    const CODE_VERIFIED = 40; //Заполнено и проверено

    const CODE_AWAIT_SENDING_TO_PARTNER = 41; //Ожидается отправка данных партнеру

    const CODE_SEND_INVITATION = 42; // Отправить приглашение
    const CODE_AWAITING_CLIENT = 43; //Ожидается клиент
    const CODE_CLIENT_VISITED = 44; //Клиент предоставил оригиналы

    const CODE_LAUNCH = 45; //Выпуск сертификата одобрен

    const CODE_USER_REQUEST = 50; //Отправлен запрос пользователя
    const CODE_USER_CREATED = 60; //Пользователь создан
    const CODE_CERTIFICATE_REQUEST_FORMED = 70; //Запрос сертификата сформирован
    const CODE_CERTIFICATE_REQUEST_SENDED = 90; //Запрос сертификата отправлен


    const CODE_CERTIFICATE_SIGNED_REQUEST_FORMED = 100; //Сформирован подписанный запрос сертификата
    const CODE_CERTIFICATE_SIGNED_REQUEST_SENDED = 110; //Отправлен подписанный запрос сертификата


    const CODE_AWAITING_BLANK = 115; //Ожидание загрузки бланка сертификата
    const CODE_AWAITING_BLANK_RESEND = 116; //Ожидание исправления бланка сертификата
    const CODE_AWAITING_BLANK_ITK_CONFIRM = 117; //Ожидание подтверждения бланка сертификата со стороны ИТК
    const CODE_AWAITING_BLANK_TRANSFER_CONFIRM = 118; //Ожидание подтверждения бланка сертификата оо стороны партнера-трансфера


    const CODE_CERTIFICATE_PAUSED = 124; //«Приостановленые» В этом состоянии находятся сертификаты, запрос на приостановление действия которых был одобрен.
    const CODE_CERTIFICATE_REVOKED = 125; //«Отозванные» В этом состоянии находятся сертификаты, запрос на отзыв  которых был одобрен.
    const CODE_CERTIFICATE_EXPIRED = 126; //«Просроченные» Сертификаты, срок действия которых истек.
    const CODE_CERTIFICATE_KEYEXPIRED = 127; //«Просроченный ключ» Сертификаты, для которых истек срок действия соответствующих ключей (задается параметром "KeyValidityPeriod" в "дополнительных параметрах" ЦР).


    const CODE_CERTIFICATE = 130; //Запрос одобрен, выпущен сертификат
    const CODE_CERTIFICATE_CONFIRMED = 140; //Запрос одобрен, выпущен сертификат, получение сертификата подтверждено пользователем


    const CODE_ACCREDITATION_LAUNCH = 500;
    const CODE_ACCREDITATION_DONE = 600;

    const CODE_SBIS_LAUNSH = 700; // Заявка СБИС одобрена


    //Предзаявка
    //"statusId": 12,  "status": "Не выходит на связь",
    //Статус ставит филиал если нет связи с клиентом по указанным данным, из этого статуса ещё можно создать заявку
    const CODE_OSNOVANIE_PRE_NO_RESPOND = 810;
    //"statusId": 20,   "status": "Создана заявка",
    //Статус ставится автоматически если из предзаявки филиал создаёт заявку
    const CODE_OSNOVANIE_PRE_CREATED = 820;
    //"statusId": 11,    "status": "Клиент отказался",
    //Статус ставит филиал если получил от клиента отказ создавать заявку, далее из предзаявки создать заявку нельзя
    const CODE_OSNOVANIE_PRE_REFUSE = 830;
    //"statusId": 13,    "status": "Прочее",
    //Статус ставит филиал в прочих случаях. из этого статуса ещё можно создать заявку
    const CODE_OSNOVANIE_PRE_OTHER = 840;
    //"statusId": 10,  "status": "Новая предзаявка",
    //Первоначальный статус предзаявки при создании
    const CODE_OSNOVANIE_SENDED = 800; //Заявка отправлена в Основание
    //Заявка
    //1 - отправка документов, - первоначальный статус заявки в котором заявка редактируемая
    const CODE_OSNOVANIE_POST_SENDING = 850;
    //11- ожидание подписи главного менеджера, - В некоторых филиалах требуется подпись Главного менеджера после подписи менеджера, архива с документами
    const CODE_OSNOVANIE_POST_AWAIT_SIGN = 855;
    //2 - генерация запроса, -  Статус в котором требуется генерация запроса в заявке, в этот статус заявка попадает после подписи менеджером или главным менеджером
    const CODE_OSNOVANIE_POST_GENERATION = 860;
    //21 - На модерации - В этот статус заявка переходит когда она УЖЕ отправлена в УЦ на модерацию
    const CODE_OSNOVANIE_POST_MODERATING = 865;
    //3 - выпуск,  - Статус в который заявка переходит после УСПЕШНОГО прохождения модерации, передана для выпуска сертификата на УЦ
    const CODE_OSNOVANIE_POST_ISSUING = 870;
    //4 - готово,  -  Сертификат выпущен и готов к выдаче клиенту
    const CODE_OSNOVANIE_DONE = 900; //Сертификат выпущен в Основании
    //5 -отказ - Временный статус если заявка не прошла Модерацию, сменяется автоматически на статус 1 - отправка документов и возвращается в Филиал для доработки
    const CODE_OSNOVANIE_POST_REFUSE = 880;

    /**
     * @var array Названия статусов
     */
    public const CODE_NAMES = [
        self::CODE_INIT              => 'Анкета не заполнена',
        self::CODE_NEED_AUTO_CHECK   => 'Идет автоматическая проверка СМЭВ',
        self::CODE_NEED_PREREQUEST   => 'Требуется сформировать запрос на выпуск сертификата',
        self::CODE_CALLBACK          => 'Требуется связаться с клиентом',
        self::CODE_FORMFILLED        => 'Анкета заполнена',
        self::CODE_REFILL            => 'Исправить документы',
        self::CODE_DOCUMENTSLOADED   => 'Требуется проверка документов',
        self::CODE_NEED_MANUAL_START => 'Требуется оплата счета',

        self::CODE_NEED_UNION_AND_PHOTO_RELOAD => 'Ошибка в заявлении или фотографии на выпуск',
        self::CODE_NEED_UNION                  => 'Загрузить заявление',
        self::CODE_NEED_UNION_RELOAD           => 'Исправить заявление',
        self::CODE_UNION_LOADED                => 'Требуется проверка заявления',

        self::CODE_AWAIT_SENDING_TO_PARTNER => 'Готов к отправке партнеру',
        self::CODE_VERIFIED        => 'Документы и анкета проверены',
        self::CODE_SEND_INVITATION => 'Отправка приглашения клиенту',
        self::CODE_AWAITING_CLIENT => 'Ожидается клиент',
        self::CODE_CLIENT_VISITED  => 'Клиент предоставил оригиналы',
        self::CODE_LAUNCH          => 'Выпуск сертификата одобрен',


        self::CODE_USER_REQUEST => 'Запрос на создание пользователя отправлен',
        self::CODE_USER_CREATED => 'Пользователь в ЦР создан',

        self::CODE_CERTIFICATE_REQUEST_DECLINED => 'Запрос отклонен',
        self::CODE_CERTIFICATE_REQUEST_FORMED   => 'Запрос на выдачу сертификата сформирован',
        self::CODE_CERTIFICATE_REQUEST_SENDED   => 'Запрос на выдачу сертификата отправлен',

        self::CODE_CERTIFICATE_PAUSED     => 'Сертификат приостановлен',
        self::CODE_CERTIFICATE_EXPIRED    => 'Сертификат просрочен',
        self::CODE_CERTIFICATE_REVOKED    => 'Сертификат отозван',
        self::CODE_CERTIFICATE_KEYEXPIRED => 'Ключ сертификата просрочен',

        self::CODE_AWAITING_BLANK                  => 'Ожидание загрузки бланка',
        self::CODE_AWAITING_BLANK_RESEND           => 'Ожидание исправленного бланка',
        self::CODE_AWAITING_BLANK_ITK_CONFIRM      => 'Ожидание подтверждения бланка со стороны УЦ',
        self::CODE_AWAITING_BLANK_TRANSFER_CONFIRM => 'Ожидание подтверждения бланка со стороны партнера-трансфера',


        self::CODE_CERTIFICATE => 'Сертификат выдан',

        self::CODE_ACCREDITATION_LAUNCH => 'Аккредитация одобрена',
        self::CODE_ACCREDITATION_DONE   => 'Аккредитация проведена',
        self::CODE_SBIS_LAUNSH          => 'Заявка СБИС одобрена',

        self::CODE_CERTIFICATE_SIGNED_REQUEST_FORMED => 'Сформирован запрос для подписания',



        //Статус ставит филиал если нет связи с клиентом по указанным данным, из этого статуса ещё можно создать заявку
        self::CODE_OSNOVANIE_PRE_NO_RESPOND=>'Предзаявка: нет связи с клиентом по указанным данным',
        //"statusId": 20,   "status": "Создана заявка",
        //Статус ставится автоматически если из предзаявки филиал создаёт заявку
        self::CODE_OSNOVANIE_PRE_CREATED =>'Предзаявка: создана заявка',
        //"statusId": 11,    "status": "Клиент отказался",
        //Статус ставит филиал если получил от клиента отказ создавать заявку, далее из предзаявки создать заявку нельзя
        self::CODE_OSNOVANIE_PRE_REFUSE=>'Предзаявка: клиент отказался',
        //"statusId": 13,    "status": "Прочее",
        //Статус ставит филиал в прочих случаях. из этого статуса ещё можно создать заявку
        self::CODE_OSNOVANIE_PRE_OTHER =>'Предзаявка: прочее',
        //"statusId": 10,  "status": "Новая предзаявка",
        //Первоначальный статус предзаявки при создании
        self::CODE_OSNOVANIE_SENDED =>'Предзаявка: отправлено партнеру', //Заявка отправлена в Основание
        //Заявка
        //1 - отправка документов, - первоначальный статус заявки в котором заявка редактируемая
        self::CODE_OSNOVANIE_POST_SENDING =>'Заявка: первоначальный статус',
        //11- ожидание подписи главного менеджера, - В некоторых филиалах требуется подпись Главного менеджера после подписи менеджера, архива с документами
        self::CODE_OSNOVANIE_POST_AWAIT_SIGN =>'Заявка: требуется подпись Главного менеджера',
        //2 - генерация запроса, -  Статус в котором требуется генерация запроса в заявке, в этот статус заявка попадает после подписи менеджером или главным менеджером
        self::CODE_OSNOVANIE_POST_GENERATION=>'Заявка: требуется генерация запроса в заявке',
        //21 - На модерации - В этот статус заявка переходит когда она УЖЕ отправлена в УЦ на модерацию
        self::CODE_OSNOVANIE_POST_MODERATING=>'Заявка: уже отправлена в УЦ на модерацию',
        //3 - выпуск,  - Статус в который заявка переходит после УСПЕШНОГО прохождения модерации, передана для выпуска сертификата на УЦ
        self::CODE_OSNOVANIE_POST_ISSUING =>'Заявка: передана для выпуска сертификата на УЦ',
        //4 - готово,  -  Сертификат выпущен и готов к выдаче клиенту
        self::CODE_OSNOVANIE_DONE=>'Заявка: сертификат выпущен и готов к выдаче клиенту', //Сертификат выпущен в Основании
        //5 -отказ - Временный статус если заявка не прошла Модерацию, сменяется автоматически на статус 1 - отправка документов и возвращается в Филиал для доработки
        self::CODE_OSNOVANIE_POST_REFUSE =>'Заявка: заявка не прошла Модерацию',
    ];

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