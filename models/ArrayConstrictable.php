<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Модель, чьи параметры можно создать из массива
 */
trait ArrayConstrictable
{
    public function __construct(array $array)
    {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}