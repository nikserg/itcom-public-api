<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Ответ от CRM
 *
 *
 */
abstract class Response
{
    use ArrayConstructable {
        __construct as protected parent_construct;
    }

    /**
     * Сырые данные, которые потом парсятся в поля модели
     *
     *
     * @var array
     */
    protected array $rawData;

    /**
     * Обработать содержимое запроса, прежде чем оно будет присвоено членам класса
     *
     * @param array $responseContent
     * @return array
     */
    protected function prepareResponseContent(array $responseContent): array
    {
        return $responseContent;
    }

    /**
     * @param array $array Данные, полученные из json_decode('ответ сервера', true)
     */
    final public function __construct(array $array)
    {
        $this->rawData = $array;
        $array = $this->prepareResponseContent($array);
        $this->parent_construct($array);
    }

    /**
     * Сырые данные, из которых была собрана модель
     *
     *
     * @return array
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }
}
