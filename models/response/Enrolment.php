<?php

namespace nikserg\ItcomPublicApi\models\response;

use nikserg\ItcomPublicApi\models\ArrayConstructable;

/**
 * Данные о сроке действия сертификата
 */
class Enrolment {
    use ArrayConstructable;

    /**
     * @var int Количество в единицах измерения
     */
    public int $CpRaCertPeriod;

    /**
     * @var string Единица измерения срока (год, месяц)
     */
    public string $CpRaCertPeriodUnits;
}
