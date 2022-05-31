<?php

namespace nikserg\ItcomPublicApi\models\request;

/**
 * На кого выпускается подпись
 */
class Target
{
    public const OWNER = 'owner'; //Руководитель (для физического лица это единственно доступный вариант)
    public const CONFIDANT = 'confidant'; //Сотрудник

    /**
     * Человекопонятные названия
     */
    public const NAMES = [
        self::OWNER     => 'Руководитель',
        self::CONFIDANT => 'Сотрудник',
    ];
}