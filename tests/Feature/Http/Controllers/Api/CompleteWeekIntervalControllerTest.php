<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;

class CompleteWeekIntervalControllerTest extends TestCase
{
    public function testValuesLessThanWeekWithoutPrecisionReturnsZero()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-06',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 0,
            ]);
    }

    public function testValueCorrectWhenPrecisionIsSet()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-06',
            'precision' => 'true',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 0.571,
            ]);
    }

    public function testAccurateValueReturnedForOneWeek()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 1,
            ]);
    }

    public function testPreciseValueReturnedForAWeekAndAHalf()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-12',
            'precision' => 'true',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 1.429,
            ]);
    }

    public function testWeekdayIntervalWithSecondsUnitReturnsCorrectSeconds()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'seconds',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 604800,
            ]);

        $this->get(route('complete-weeks-interval', [
            'startDate' => '2021-10-02T10:30:00.000-06:00', // chicago time
            'endDate' => '2021-10-20T10:30:00.000+09:30', // adelaide time
            'units' => 'seconds',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '1209600',
            ]);
    }

    public function testWeekdayIntervalWithMinutesUnitReturnsCorrectMinutes()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'minutes',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 10080,
            ]);
    }

    public function testWeekdayIntervalWithHoursUnitReturnsCorrectHours()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'hours',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 168,
            ]);
    }

    public function testWeekdayIntervalWithYearsSpecifiedReturnsCorrectYears()
    {
        $this->get(route('complete-weeks-interval', [
            'startDate' => '2021-09-02',
            'endDate' => '2022-09-02',
            'units' => 'years',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 1,
            ]);
    }
}
