<?php

namespace nikserg\ItcomPublicApi\exceptions;


use Throwable;

class NotFoundException extends Exception
{
    public int $id;
    public function __construct(int $id, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Не найдена заявка #'.$id.' '.$message, $code, $previous);
    }
}