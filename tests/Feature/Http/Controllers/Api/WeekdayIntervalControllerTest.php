<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;

class WeekdayIntervalControllerTest extends TestCase
{
    public function testWeekdayIntervalWithoutUnitsSpecifiedReturnsCorrectDays()
    {
        $this->get(route('weekdays-interval', [
            'startDate' => '2024-08-31', // saturday
            'endDate' => '2024-09-06', // friday
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 5,
            ]);
    }

    public function testWeekdayIntervalWithoutUnitOnWeekendDaysReturnsZero()
    {
        $this->get(route('weekdays-interval', [
            'startDate' => '2024-08-31', // saturday
            'endDate' => '2024-09-01', // sunday
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 0,
            ]);

        $this->get(route('weekdays-interval', [
            'startDate' => '2024-01-01', // start of year
            'endDate' => '2024-12-31', // end of year
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '262',
            ]);
    }

    public function testWeekdayIntervalWithSecondsUnitSpecifiedReturnsCorrectSeconds()
    {
        $this->get(route('weekdays-interval', [
            'startDate' => '2024-08-31', // saturday
            'endDate' => '2024-09-06', // friday
            'units' => 'seconds',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '432000',
            ]);

        $this->get(route('weekdays-interval', [
            'startDate' => '2024-01-01', // start of year
            'endDate' => '2024-12-31', // end of year
            'units' => 'seconds',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '22636800',
            ]);
    }

    public function testWeekdayIntervalWithSecondsUnitSpecifiedReturnsCorrectMinutes()
    {
        $this->get(route('weekdays-interval', [
            'startDate' => '2024-08-31', // saturday
            'endDate' => '2024-09-06', // friday
            'units' => 'minutes',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '7200',
            ]);

        $this->get(route('weekdays-interval', [
            'startDate' => '2024-01-01', // start of year
            'endDate' => '2024-12-31', // end of year
            'units' => 'minutes',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '377280',
            ]);
    }

    public function testWeekdayIntervalWithSecondsUnitSpecifiedReturnsCorrectHours()
    {
        $this->get(route('weekdays-interval', [
            'startDate' => '2024-08-31', // saturday
            'endDate' => '2024-09-06', // friday
            'units' => 'hours',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '120',
            ]);

        $this->get(route('weekdays-interval', [
            'startDate' => '2024-01-01', // start of year
            'endDate' => '2024-12-31', // end of year
            'units' => 'hours',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '6288',
            ]);
    }

    public function testWeekdayIntervalWithSecondsUnitSpecifiedReturnsCorrectYears()
    {
        $this->get(route('weekdays-interval', [
            'startDate' => '2024-08-31', // saturday
            'endDate' => '2024-09-06', // friday
            'units' => 'years',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '0.014',
            ]);

        $this->get(route('weekdays-interval', [
            'startDate' => '2024-01-01', // start of year
            'endDate' => '2024-12-31', // end of year
            'units' => 'years',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '0.718',
            ]);
    }
}
