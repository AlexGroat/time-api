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
    public function unitConversion(): int
    {
        $response = null;

        if ($this->units === TimeUnitsEnum::SECONDS->value) {
            $response = $this->timeIntervalInSeconds;
        }

        if ($this->units === TimeUnitsEnum::MINUTES->value) {
            $response = $this->timeIntervalInSeconds / 60; // seconds in a
            // minute
        }

        if ($this->units === TimeUnitsEnum::HOURS->value) {
            $response = $this->timeIntervalInSeconds / 3600; // seconds in an
            // hour
        }

        if ($this->units === TimeUnitsEnum::YEARS->value) {
            $response = $this->timeIntervalInSeconds / 31536000; // seconds in
            // a year
        }

        return (int) $response;
    }
}
