<?php

namespace nikserg\ItcomPublicApi\models\response;

use nikserg\ItcomPublicApi\models\Response;

/**
 * Простой ответ от CRM, который не предполагает возврата каких-либо данных.
 * Информация об ошибке или успешном выполнении.
 */
class Code extends Response
{
    /**
     * Код ошибки. 0 - успех
     *
     * @var int
     */
    public int $code;

    /**
     * Сообщение об ошибке
     *
     *
     * @var string|null
     */
    public ?string $message;


    /**
     * Является ли код успешным выполнением
     *
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->code == 0;
    }

    protected function prepareResponseContent(array $responseContent): array
    {
        $responseContent['code'] = intval($responseContent['code']);

        return $responseContent;
    }
}
