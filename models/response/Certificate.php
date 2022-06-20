<?php

namespace nikserg\ItcomPublicApi\models\response;

use nikserg\ItcomPublicApi\models\Document;
use nikserg\ItcomPublicApi\models\Field;
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
     * @var \nikserg\ItcomPublicApi\models\Status
     */
    public Status $status;

    /**
     * Список требуемых документов
     *
     *
     * @var \nikserg\ItcomPublicApi\models\Document[] $documents
     */
    public array $documents;

    /**
     * Список полей анкеты
     *
     *
     * @var \nikserg\ItcomPublicApi\models\Field[] $fields
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


    protected function prepareResponseContent(array $responseContent): array
    {
        $responseContent['isGKFH'] = boolval($responseContent['isGKFH'] ?? false);
        $responseContent['isMinor'] = boolval($responseContent['isMinor'] ?? false);
        $responseContent['isMep'] = boolval($responseContent['isMep'] ?? false);
        $responseContent['isForeignCompany'] = boolval($responseContent['isForeignCompany'] ?? false);
        $responseContent['noColorScan'] = boolval($responseContent['noColorScan'] ?? false);
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
        preg_match('/token=(.+)/', $this->link, $matches);

        return $matches[1] ?? '';
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
}
