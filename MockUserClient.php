<?php

namespace nikserg\ItcomPublicApi;

use GuzzleHttp\Utils;
use http\Client;
use nikserg\ItcomPublicApi\models\request\CryptoProvider;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Platform;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\response\Certificate;

/**
 * Клиент для тестирования, без реальных запросов
 * Авторизация как пользователь
 *
 *
 */
class MockUserClient extends UserClient
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
        "code": "7",
        "name": "Требуется сформировать запрос на выпуск сертификата",
        "description": ""
    },
    "documents": [
        {
            "id": "union",
            "name": "Заявление на изготовление сертификата ключа проверки электронной подписи",
            "description": "Оригинал с подписью, который остается в Удостоверяющем центре.Подпись строго как в паспорте. Факсимиле не допустимо. Печать (при наличии) и подпись должны быть синего цвета.",
            "uploaded": false
        },
        {
            "id": "cert_request",
            "name": "Запрос на выдачу сертификата ключа проверки электронной подписи",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        },
        {
            "id": "passportfacephoto",
            "name": "Фотография владельца сертификата с паспортом и заявлением",
            "description": "Фотография владельца сертификата c паспортом, раскрытого на странице с фотографией, и заявления на выпуск сертификата, чтобы мы могли удостоверить личность владельца этого паспорта. \nФотография с подписанным заявлением и паспортом должна быть сделана в офисе партнера при идентификации личности и включать: указание текущей даты - табличка с датой, часы с крупным изображением даты, календарь на стене.\nПожалуйста, ознакомьтесь с примером такой фотографии.",
            "uploaded": false
        },
        {
            "id": "passportphoto",
            "name": "Паспорт владельца сертификата (страница с фотографией)",
            "description": "Загружается надлежащим образом удостоверенная копия",
            "uploaded": false
        },
        {
            "id": "passportregistration",
            "name": "Паспорт владельца сертификата (страница с актуальной пропиской)",
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
    "fields": {
        "0": {
            "id": "email",
            "name": "Электронный адрес",
            "required": true,
            "type": "string",
            "value": "rh@uc-stolica.ru"
        },
        "2": {
            "id": "SNILS",
            "name": "СНИЛС",
            "required": true,
            "type": "string",
            "value": "14011862813"
        },
        "3": {
            "id": "phone",
            "name": "Телефон",
            "required": true,
            "type": "string",
            "value": "+70000000000"
        },
        "4": {
            "id": "fiasAddress",
            "name": "Адрес прописки",
            "required": false,
            "type": "string",
            "value": null
        },
        "5": {
            "id": "region",
            "name": "Регион",
            "required": false,
            "type": "string",
            "value": "16 Республика Татарстан",
            "group": {
                "id": "address",
                "name": "Адрес (населенный пункт\/город согласно прописки)"
            }
        },
        "6": {
            "id": "city",
            "name": "Город населенный пункт",
            "required": false,
            "type": "string",
            "value": "Казань",
            "group": {
                "id": "address",
                "name": "Адрес (населенный пункт\/город согласно прописки)"
            }
        },
        "7": {
            "id": "passportSeries",
            "name": "Серия",
            "required": false,
            "type": "string",
            "value": "9212",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "8": {
            "id": "passportNumber",
            "name": "Номер",
            "required": true,
            "type": "string",
            "value": "328882",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "9": {
            "id": "passportDate",
            "name": "Дата выдачи",
            "required": true,
            "type": "string",
            "value": "15.05.2012",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "10": {
            "id": "ownerCountry",
            "name": "Страна гражданства",
            "required": true,
            "type": "string",
            "value": "RUS",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "11": {
            "id": "ownerPassportDeptCode",
            "name": "Код подразделения",
            "required": true,
            "type": "string",
            "value": "160-009",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "12": {
            "id": "ownerBirthDate",
            "name": "Дата рождения",
            "required": true,
            "type": "string",
            "value": "28.04.1992",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "13": {
            "id": "ownerBirthPlace",
            "name": "Место рождения",
            "required": true,
            "type": "string",
            "value": "гор. Набережные Челны",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "14": {
            "id": "passportIssuer",
            "name": "Кем выдан",
            "required": true,
            "type": "string",
            "value": "УМВД г. Казани",
            "group": {
                "id": "passport",
                "name": "Паспорт"
            }
        },
        "15": {
            "id": "ownerLastName",
            "name": "Фамилия",
            "required": true,
            "type": "string",
            "value": "Хайрутдинов",
            "group": {
                "id": "ownerName",
                "name": " "
            }
        },
        "16": {
            "id": "ownerFirstName",
            "name": "Имя",
            "required": true,
            "type": "string",
            "value": "Руслан",
            "group": {
                "id": "ownerName",
                "name": " "
            }
        },
        "17": {
            "id": "ownerMiddleName",
            "name": "Отчество",
            "required": false,
            "type": "string",
            "value": "Айратович",
            "group": {
                "id": "ownerName",
                "name": " "
            }
        },
        "18": {
            "id": "ownerGender",
            "name": "Пол",
            "required": true,
            "type": "string",
            "value": "1",
            "group": {
                "id": "ownerName",
                "name": " "
            }
        },
        "19": {
            "id": "INNFL",
            "name": "ИНН",
            "required": true,
            "type": "string",
            "value": "165125702012"
        }
    },
    "link": "https:\/\/crm.uc-itcom.ru\/app\/index.php\/customerForms\/external?token=d82d32c2ad253e45d521d84b757c440cind",
    "legalForm": "person",
    "target": "owner",
    "embededCP": "0",
    "isGKFH": "0",
    "isForeigner": "0",
    "isMinor": "0",
    "isForeignCompany": "0",
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
    "createDate": "2022-05-24 13:13:09",
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
        if ($id === null) {
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
            if (isset($field['group'])) {
                $field['group'] = (array)$field['group'];
            }
        }
        $return['status'] = (array)$return['status'];

        return $return;
    }
}
