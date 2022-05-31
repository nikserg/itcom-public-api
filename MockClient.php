<?php

namespace nikserg\ItcomPublicApi;

use GuzzleHttp\Utils;
use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;
use nikserg\ItcomPublicApi\models\Status;

/**
 * Клиент для тестирования, без реальных запросов
 *
 *
 */
class MockClient extends Client
{
    public function createOrUpdate(
        array $platforms = [Platform::EPGU],
        ?int $id = null,
        ?string $name = null,
        string $legalForm = LegalForm::LEGAL,
        string $target = Target::CONFIDANT,
        string $cryptoProvider = CryptoProvider::CRYPTO_PRO_2012,
        bool $embeddedCp = false,
        bool $isForeigner = false,
        bool $isMep = false
    ): Certificate {
        $json = '{
    "id": 1,
    "platforms": [
        "EPGU"
    ],
    "status": {
        "code": null,
        "name": "Анкета не заполнена",
        "description": "Заявка на сертификат создана, ожидается заполнение анкеты."
    },
    "documents": [
        {
            "id": "union",
            "name": "Заявление на изготовление сертификата ключа проверки электронной подписи",
            "description": "Оригинал с подписью и печатью, который остается в Удостоверяющем центре.Подпись строго как в паспорте. Факсимиле не допустимо. Печать (при наличии) и подпись должны быть синего цвета.",
            "uploaded": false
        },
        {
            "id": "cert_request",
            "name": "Запрос на выдачу сертификата ключа проверки электронной подписи",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        },
        {
            "id": "passportphoto",
            "name": "Паспорт владельца сертификата (страница с фотографией)",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        },
        {
            "id": "distinctConfidence",
            "name": "Доверенность от руководителя по выписке о предоставлении прав действовать от имени ЮЛ",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        },
        {
            "id": "snils",
            "name": "Страховое свидетельство государственного пенсионного страхования (СНИЛС) владельца сертификата",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        },
        {
            "id": "additional",
            "name": "Прочие (при необходимости)",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        }
    ],
    "fields": [
        {
            "id": "organizationShortName",
            "name": "Организация",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "street",
            "name": "Улица, дом, корпус, офис\/квартира",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "departmentName",
            "name": "Отдел",
            "required": false,
            "type": "string",
            "value": "Администрация"
        },
        {
            "id": "ownerPosition",
            "name": "Должность",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "email",
            "name": "Электронный адрес",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "passportSeries",
            "name": "Серия",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "SNILS",
            "name": "СНИЛС",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "phone",
            "name": "Телефон",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "fiasAddress",
            "name": "Адрес",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "region",
            "name": "Регион",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "city",
            "name": "Город\/населенный пункт",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "street",
            "name": "Улица, дом, корпус, офис\/квартира",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "passportSeries",
            "name": "Серия",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "passportNumber",
            "name": "Номер",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "passportDate",
            "name": "Дата выдачи",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerCountry",
            "name": "Страна гражданства",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerPassportDeptCode",
            "name": "Код подразделения",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerBirthDate",
            "name": "Дата рождения",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerBirthPlace",
            "name": "Место рождения",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "passportIssuer",
            "name": "Кем выдан",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerLastName",
            "name": "Фамилия",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerFirstName",
            "name": "Имя",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerMiddleName",
            "name": "Отчество",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerGender",
            "name": "Пол",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerINN",
            "name": "ИНН",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "INN",
            "name": "ИНН",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "OGRN",
            "name": "ОГРН",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "KPP",
            "name": "КПП",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "authorityDocumentType",
            "name": "Тип документа, подтверждающего полномочия",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "authorityDocumentNumber",
            "name": "Номер доверенности",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "authorityDocumentDate",
            "name": "Дата доверенности",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "authorityDocument",
            "name": "Основание полномочий",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "ownerINN",
            "name": "ИНН",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "employeeTermAuthorityDocument",
            "name": "Срок действия доверенности",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "employeeTermAuthorityDocumentDate",
            "name": "Дата срока действия договора",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "headLastName",
            "name": "Фамилия",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "headFirstName",
            "name": "Имя",
            "required": true,
            "type": "string",
            "value": null
        },
        {
            "id": "headMiddleName",
            "name": "Отчество",
            "required": false,
            "type": "string",
            "value": null
        },
        {
            "id": "safeEgrulOwner",
            "name": "СМЭВ по владельцу успешно проверен",
            "required": false,
            "type": "boolean",
            "value": null
        },
        {
            "id": "headPosition",
            "name": "Должность",
            "required": true,
            "type": "string",
            "value": null
        }
    ],
    "link": "https:\/\/dev.uc-itcom.ru\/app\/index.php\/customerForms\/external?token=1ab6644e6fd3f41ade700cfcd86ab7f0ind",
    "legalForm": "legal",
    "target": "confidant",
    "embededCP": "0",
    "isGKFH": null,
    "isForeigner": "0",
    "isMinor": null,
    "isForeignCompany": null,
    "noColorScan": "0",
    "cryptoProvider": "CRYPTO_PRO_2012",
    "oids": [
        "1.3.6.1.5.5.7.3.4",
        "1.2.643.2.2.34.6",
        "1.3.6.1.5.5.7.3.2",
        "1.2.643.3.296.15.6",
        "1.2.643.3.296.12",
        "1.2.643.3.296"
    ],
    "createDate": "2022-05-31 09:22:17",
    "issueDate": null,
    "isMep": "0",
    "isNewProcess": true
}';
        $decoded = Utils::jsonDecode($json, true);
        return new Certificate($decoded);
    }
}