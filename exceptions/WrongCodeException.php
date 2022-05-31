<?php

namespace nikserg\ItcomPublicApi\exceptions;


use nikserg\ItcomPublicApi\models\response\Code;
use Throwable;

/**
 * Ответ от CRM, который содержит неправильный код
 */
class WrongCodeException extends Exception
{
    public Code $crmResponse;

    public function __construct(Code $crmResponse, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->crmResponse = $crmResponse;
        parent::__construct($this->crmResponse->code . ': ' . $this->crmResponse->message . '. ' . $message, $code,
            $previous);
    }
}