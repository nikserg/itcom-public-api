<?php

namespace nikserg\ItcomPublicApi;

use GuzzleHttp\Utils;
use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;

/**
 * Клиент для тестирования, без реальных запросов
 *
 *
 */
class MockClient extends Client
{
    /**
     * @var Certificate[]
     */
    private ?array $certificates = null;
    private int $currentId = 1;

    /**
     * Имя файла локального хранилища, в котором хранятся данные для персистентности между запросами.
     * Это имитирует БД системы на той стороне API.
     *
     *
     * @return string
     */
    private function dbFile(): string
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'itcomPublicApiMock';
    }

    /**
     * Загрузить данные из локального хранилища
     *
     *
     * @return void
     */
    private function load(): void
    {
        if ($this->certificates === null) {
            if (file_exists($this->dbFile())) {
                $content = unserialize(file_get_contents($this->dbFile()));
                $this->certificates = $content['certificates'];
                $this->currentId = $content['currentId'];
            } else {
                $this->certificates = [];
                $this->save();
            }
        }
    }

    /**
     * Сохранить текущие данные в локальное хранилище
     *
     *
     * @return void
     */
    private function save(): void
    {
        file_put_contents($this->dbFile(),
            serialize(['certificates' => $this->certificates, 'currentId' => $this->currentId]));
    }

    /**
     * Тестовая информация о сертификате
     *
     *
     * @param int $id
     * @return \nikserg\ItcomPublicApi\models\response\Certificate
     */
    private function dummyCertificate(int $id): Certificate
    {
        $this->load();
        if (isset($this->certificates[$id])) {
            return $this->certificates[$id];
        }
        $json = '{
    "id": ' . $id . ',
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

        $this->certificates[$id] = new Certificate($decoded);

        return $this->certificates[$id];
    }

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
        if (!$id) {
            $id = $this->currentId++;
        }

        return $this->dummyCertificate($id);
    }

    public function view(int $id): Certificate
    {
        return $this->dummyCertificate($id);
    }

    /**
     * @throws \nikserg\ItcomPublicApi\exceptions\NotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fill(int $id, array $fields): void
    {
        $certificate = $this->view($id);
        foreach ($fields as $field) {
            foreach ($certificate->fields as $certificateField) {
                if ($certificateField->id == $field->id) {
                    $certificateField->value = $field->value;
                }
            }
        }
        $rawData = $this->makeRawData($certificate);
        $certificate = new Certificate($rawData);
        $this->certificates[$certificate->id] = $certificate;
        $this->save();
    }

    /**
     * Создает сырые данные, которые вернулись бы из метода, например,
     * certificate/view, если бы была запрошена такая заявка
     *
     *
     * @param \nikserg\ItcomPublicApi\models\response\Certificate $certificate
     * @return array
     */
    private function makeRawData(Certificate $certificate): array
    {
        $return = (array)$certificate;
        unset($return["\0*\0rawData"]);
        foreach ($return['documents'] as &$document) {
            $document = (array)$document;
        }
        foreach ($return['fields'] as &$field) {
            $field = (array)$field;
        }
        $return['status'] = (array)$return['status'];

        return $return;
    }
}