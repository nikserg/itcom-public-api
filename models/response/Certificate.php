<?php

namespace nikserg\ItcomPublicApi\models\response;

use nikserg\ItcomPublicApi\exceptions\InvalidConstructorArrayException;
use nikserg\ItcomPublicApi\models\Document;
use nikserg\ItcomPublicApi\models\Field;
use nikserg\ItcomPublicApi\models\request\LegalForm;
use nikserg\ItcomPublicApi\models\request\Target;
use nikserg\ItcomPublicApi\models\Response;
use nikserg\ItcomPublicApi\models\Status;

/**
 * Данные о заявке на выпуск сертификата
 */
class Certificate extends Response
{
    /**
     * ID заявки
     *
     *
     * @var int
     */
    public int $id;

    /**
     * Список площадок
     *
     * @see \nikserg\ItcomPublicApi\models\request\Platform
     * @var array
     */
    public array $platforms;

    /**
     * Статус заявки
     *
     *
     * @var Status
     */
    public Status $status;

    /**
     * Список требуемых документов
     *
     *
     * @var Document[] $documents
     */
    public array $documents;

    /**
     * Список полей анкеты
     *
     *
     * @var Field[] $fields
     */
    public array $fields;

    /**
     * Ссылка для пользователя для заполнения анкеты
     *
     *
     * @var string
     */
    public string $link;

    /**
     * Организационно-правовая форма владельца
     *
     * @see \nikserg\ItcomPublicApi\models\request\LegalForm
     * @var string
     */
    public string $legalForm;

    /**
     * На кого выпускается подпись
     *
     * @see \nikserg\ItcomPublicApi\models\request\Target
     * @var string
     */
    public string $target;

    /**
     * Есть встроенная лицензия КриптоПро
     *
     *
     * @var bool
     */
    public bool $embededCP;

    /**
     * Владелец подписи является главой крестьянско-фермерского хозяйства
     *
     *
     * @var bool
     */
    public bool $isGKFH;

    /**
     * Владелец подписи - иностранец
     *
     *
     * @var bool
     */
    public bool $isForeigner;

    /**
     * Владелец подписи - несовершеннолетний
     *
     *
     * @var bool
     */
    public bool $isMinor;

    /**
     * Выпуск на иностранную организацию
     *
     *
     * @var bool
     */
    public bool $isForeignCompany;

    /**
     * Цветные сканы, либо сканы хорошего качества
     *
     *
     * @var bool
     */
    public bool $noColorScan;

    /**
     * Заявка с признаком МЭП. Для создания таких заявок требуется специальное разрешение.
     *
     * @var bool
     */
    public bool $isMep;
    /**
     * Новый процесс выпуска сертификатов
     *
     * @var bool
     */
    public bool $isNewProcess;
    /**
     * Второй новый процесс выпуска сертификатов
     *
     * @var bool
     */
    public bool $isNewProcess2;

    /**
     * Криптопровайдер, который используется при генерации подписи
     *
     * @see \nikserg\ItcomPublicApi\models\request\CryptoProvider
     * @var string
     */
    public string $cryptoProvider;

    /**
     * Список ОИДов, которые будут содержаться в выпущенном сертификате
     *
     * @var string[]
     */
    public array $oids;

    /**
     * Дата создания зявки на сертификат
     *
     *
     * @var string
     */
    public string $createDate;

    /**
     * Дата выпуска сертификата (только для выпущенных)
     *
     *
     * @var string|null
     */
    public ?string $issueDate;

    /**
     * Выпуск через Доверенный Удостоверяющий Центр.
     *
     * Обычно происходит для сертификатов на руководителей организаций или ИП.
     *
     * @var bool
     */
    public bool $isDuc;

    /**
     * ID продлеваемой заявки
     *
     *
     * @var int|null
     */
    public ?int $prolongationId;

    /**
     * ID владельца заявки
     *
     *
     * @var int|null
     */
    public ?int $ownerId;

    /**
     * Выпуск через IDPoint
     *
     *
     * @var bool
     */
    public bool $isIdpoint;

    /**
     * @throws InvalidConstructorArrayException
     */
    protected function prepareResponseContent(array $responseContent): array
    {
        if (empty($responseContent)) {
            throw new InvalidConstructorArrayException('Передан пустой массив для создания заявки на сертификат');
        }
        $responseContent['ownerId'] = $responseContent['ownerId'] ?? null;
        $responseContent['prolongationId'] = $responseContent['prolongationId'] ?? null;
        $responseContent['isGKFH'] = boolval($responseContent['isGKFH'] ?? false);
        $responseContent['isMinor'] = boolval($responseContent['isMinor'] ?? false);
        $responseContent['isMep'] = boolval($responseContent['isMep'] ?? false);
        $responseContent['isDuc'] = boolval($responseContent['isDuc'] ?? false);
        $responseContent['isForeignCompany'] = boolval($responseContent['isForeignCompany'] ?? false);
        $responseContent['noColorScan'] = boolval($responseContent['noColorScan'] ?? false);
        $responseContent['isIdpoint'] = boolval($responseContent['isIdpoint'] ?? false);

        if (!isset($responseContent['status'])) {
            throw new InvalidConstructorArrayException('В массиве для создания заявки на сертификат нет ключа status. Передан массив ' . print_r($responseContent,
                    true));
        }
        $responseContent['status'] = new Status($responseContent['status']);
        $responseContent['isForeigner'] = boolval($responseContent['isForeigner'] ?? false);
        $responseContent['isNewProcess'] = boolval($responseContent['isNewProcess'] ?? false);
        $responseContent['isNewProcess2'] = boolval($responseContent['isNewProcess2'] ?? false);

        foreach ($responseContent['fields'] as $key => $value) {
            $responseContent['fields'][$key] = new Field($value);
        }
        foreach ($responseContent['documents'] as $key => $value) {
            $responseContent['documents'][$key] = new Document($value);
        }

        return $responseContent;
    }

    /**
     * Получить токен доступа для заявки
     *
     *
     * @return string
     */
    public function getToken(): string
    {
        $matches = [];
        preg_match('/[a-z\d]{32}ind/', $this->link, $matches);

        return $matches[0] ?? '';
    }

    /**
     * Объединенный токен, вида 1_299d37000a26677fa3049816558a816eind
     *
     *
     * @return string
     */
    public function getCombinedToken(): string
    {
        return $this->id . '_' . $this->getToken();
    }

    /**
     * Загружен ли документ
     *
     * @param string $documentId
     * @return bool
     * @see Document
     */
    public function isDocumentUploaded(string $documentId): bool
    {
        if ($document = $this->getDocumentById($documentId)) {
            return $document->uploaded;
        }

        return false;
    }

    /**
     * Получить документ по ID
     *
     *
     * @param string $documentId
     * @return Document|null
     */
    public function getDocumentById(string $documentId): ?Document
    {
        foreach ($this->documents as $document) {
            if ($document->id == $documentId) {
                return $document;
            }
        }

        return null;
    }


    /**
     * Получить значение поля анкеты, если оно существует (и если значение задано)
     *
     *
     * @param string $fieldId ID поля
     * @return mixed|null
     */
    public function getFieldValue(string $fieldId): mixed
    {
        foreach ($this->fields as $field) {
            if ($field->id == $fieldId) {
                return $field->value;
            }
        }

        return null;
    }

    /**
     * ИП?
     *
     *
     * @return bool
     */
    public function isIp(): bool
    {
        return $this->legalForm == LegalForm::INDIVIDUAL;
    }

    /**
     * Выпуск на руководителя юридического лица или на индивидуального предпринимателя
     *
     *
     * @return bool
     */
    public function isHeadOrIp(): bool
    {
        return $this->isIp() || ($this->legalForm == LegalForm::LEGAL && $this->target == Target::OWNER);
    }

    /**
     * Продление ключ ключом?
     *
     * @return bool
     */
    public function isKeyProlongation(): bool
    {
        return in_array('EPGU_DUC_KEY_PROLONGATION', $this->platforms);
    }
}
