<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;

class DayIntervalControllerTest extends TestCase
{
    public function testDayIntervalWithoutUnitsSpecifiedReturnsCorrectDays()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 7,
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2022-09-02',
            'endDate' => '2023-09-02',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => 365,
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2021-10-02T10:30:00.000-06:00', // chicago time
            'endDate' => '2021-10-05T10:30:00.000+09:30', // adelaide time
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '2.35',
            ]);
    }

    public function testDayIntervalWithSecondUnitReturnsCorrectSeconds()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'seconds',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '604800',
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2021-10-02T10:30:00.000-06:00', // chicago time
            'endDate' => '2021-10-05T10:30:00.000+09:30', // adelaide time
            'units' => 'seconds',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '203400',
            ]);
    }

    public function testDayIntervalWithSecondUnitReturnsCorrectMinutes()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'minutes',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '10080',
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2021-10-02T10:30:00.000-06:00', // chicago time
            'endDate' => '2021-10-05T10:30:00.000+09:30', // adelaide time
            'units' => 'minutes',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '3390',
            ]);
    }

    public function testDayIntervalWithHourUnitReturnsCorrectHours()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'hours',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '168',
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2021-10-02T10:30:00.000-06:00', // chicago time
            'endDate' => '2021-10-05T10:30:00.000+09:30', // adelaide time
            'units' => 'hours',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '56.5',
            ]);
    }

    public function testDayIntervalWithYearUnitReturnsCorrectYears()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-09',
            'units' => 'years',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '0.019',
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2021-10-02T10:30:00.000-06:00', // chicago time
            'endDate' => '2021-10-05T10:30:00.000+09:30', // adelaide time
            'units' => 'years',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '0.006',
            ]);

        $this->get(route('days-interval', [
            'startDate' => '2020-10-05T10:30:00.000+09:30',
            'endDate' => '2021-10-05T10:30:00.000+09:30', // adelaide time
            'units' => 'years',
        ]))
            ->assertJson([
                'success' => true,
                'message' => 'Operation successful.',
                'data' => '1',
            ]);
    }
}
