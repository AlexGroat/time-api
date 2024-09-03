<?php

namespace App\Services;

use App\Enums\TimeUnitsEnum;

class TimeUnitService
{
    protected int $timeIntervalInSeconds;

    protected string $units;

    public function __construct(int $timeIntervalInSeconds, string $units)
    {
        $this->timeIntervalInSeconds = $timeIntervalInSeconds;
        $this->units = $units;
    }

    /**
     * Convert the time interval in seconds to the specified time unit.
     */
    public function unitConversion(): int|float
    {
        $unitDivisors = [
            TimeUnitsEnum::SECONDS->value => 1,
            TimeUnitsEnum::MINUTES->value => 60,
            TimeUnitsEnum::HOURS->value => 3600,
            TimeUnitsEnum::YEARS->value => 31536000,
        ];

        $divisor = $unitDivisors[$this->units];

        return round($this->timeIntervalInSeconds / $divisor, 3);
    }
}
