<?php

namespace nikserg\ItcomPublicApi\models\request;

/**
 * Организационно-правовые формы клиента
 */
class LegalForm
{
    public const LEGAL = 'legal'; //Юридическое лицо
    public const INDIVIDUAL = 'individual'; //Индивидуальный предприниматель
    public const PERSON = 'person'; //Физическое лицо
}