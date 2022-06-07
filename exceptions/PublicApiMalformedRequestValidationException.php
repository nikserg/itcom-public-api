<?php

namespace nikserg\ItcomPublicApi\exceptions;

use Throwable;

/**
 * Ошибка при валидации анкеты на стороне CRM
 */
class PublicApiMalformedRequestValidationException extends PublicApiMalformedRequestException
{
    public array $validationErrors = [];

    public function __construct(array $json, ?Throwable $previous = null)
    {
        $this->validationErrors = $json['validationErrors'];
        parent::__construct($json, $previous);
    }
}
