<?php

namespace nikserg\ItcomPublicApi\models;

use Psr\Http\Message\ResponseInterface;

/**
 * Ответ от CRM
 */
abstract class Response
{
    use ArrayConstrictable {
        __construct as protected parent_construct;
    }

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

    final public function __construct(array $array)
    {
        $array = $this->prepareResponseContent($array);
        $this->parent_construct($array);
    }
}