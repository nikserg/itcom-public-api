<?php

namespace nikserg\ItcomPublicApi\models\response;

use nikserg\ItcomPublicApi\exceptions\InvalidJsonException;
use nikserg\ItcomPublicApi\models\Response;

/**
 * Данные для создания req-файла
 */
class RequestData extends Response
{
    /*
 * {
    "subjectFields": [
            {
                "oid": "1.2.643.100.3",
                "value": "11223344595"
            },
            {
                "oid": "1.2.643.3.131.1.1",
                "value": "770105567640"
            },
            {
                "oid": "1.2.840.113549.1.9.1",
                "value": "weg@egeg.eg"
            },
            {
                "oid": "2.5.4.6",
                "value": "RU"
            },
            {
                "oid": "2.5.4.8",
                "value": "20 Чеченская Республика"
            },
            {
                "oid": "2.5.4.7",
                "value": "Грозный"
            },
            {
                "oid": "2.5.4.3",
                "value": "3123 1231231 232131"
            },
            {
                "oid": "2.5.4.42",
                "value": "1231231 232131"
            },
            {
                "oid": "2.5.4.4",
                "value": "3123"
            }
        ],
        "keyUsage": {
            "digitalSignature": false,
            "nonRepudiation": false,
            "keyEncipherment": false,
            "dataEncipherment": false,
            "keyAgreement": false,
            "keyCertSign": false,
            "cRLSign": false,
            "encipherOnly": false,
            "decipherOnly": false
        },
        "extensionOIDs": [
            "1.3.6.1.5.5.7.3.4",
            "1.2.643.2.2.34.6",
            "1.3.6.1.5.5.7.3.2",
            "1.2.643.3.296.15.6",
            "1.2.643.3.296.12",
            "1.2.643.3.296",
            "1.2.643.2.2.49.2"
        ],
        "identificationKind": 0,
        "subjectSignTool": "КриптоПРО CSP",
        "enrolment": {
            "CpRaCertPeriod": "12",
            "CpRaCertPeriodUnits": "Months"
        },
        "certificateTemplate": "1.2.643.2.2.46.0.8"
    }
*/
    /**
     * @var int
     */
    public int $customerFormId;
    
    /**
     * @var string
     */
    public string $cryptoProvider;

    /**
     * @var int
     */
    public int $uc;

    /**
     * @var bool
     */
    public bool $exportableKey;

    /**
     * @var SubjectField[]
     */
    public array $subjectFields;

    /**
     * @var KeyUsage
     */
    public KeyUsage $keyUsage;

    /**
     * @var string[]
     */
    public array $extensionOIDs;

    /**
     * @var int
     */
    public int $identificationKind;

    /**
     * @var string
     */
    public string $subjectSignTool;

    /**
     * @var Enrolment
     */
    public ?Enrolment $enrolment;

    /**
     * @var ?string
     */
    public ?string $certificateTemplate;

    /**
     * @var bool
     */
    public bool $isCloud;

    /**
     * @param array $responseContent
     * @return array
     * @throws InvalidJsonException
     */
    protected function prepareResponseContent(array $responseContent): array
    {
        if (!isset($responseContent['subjectFields'])) {
            throw new InvalidJsonException('Не найдено поле subjectFields при разборе данных для формирования req-файла в ответе ' . print_r($responseContent, true));
        }
        foreach ($responseContent['subjectFields'] as $key => $value) {
            $responseContent['subjectFields'][$key] = new SubjectField($value);
        }
        $responseContent['keyUsage'] = new KeyUsage($responseContent['keyUsage']);
        $responseContent['enrolment'] = isset($responseContent['enrolment']) ? new Enrolment($responseContent['enrolment']) : null;

        return $responseContent;
    }
}
