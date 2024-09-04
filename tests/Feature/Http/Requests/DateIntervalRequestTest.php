<?php

namespace Tests\Feature\Http\Requests;

use App\Enums\TimeUnitsEnum;
use Tests\TestCase;

class DateIntervalRequestTest extends TestCase
{
    public function testStartAndEndDateAreRequired()
    {
        $this->get(route('days-interval'))
            ->assertJsonValidationErrors([
                'startDate',
                'endDate',
            ])
            ->assertJsonFragment([
                'endDate' => ['The end date is required. Please provide one.'],
                'startDate' => ['The start date is required. Please provide one.'],
            ])
            ->assertJsonFragment([
                'message' => 'Validation Error',
                'success' => false,
            ]);
    }

    public function testStartAndEndDateMustBeDateFormat()
    {
        $this->get(route('days-interval', [
            'startDate' => 'invalid',
            'endDate' => 'invalid',
        ]))
            ->assertJsonValidationErrors([
                'startDate',
                'endDate',
            ])
            ->assertJsonFragment([
                'startDate' => [
                    'The start date must be before the end date.',
                    'The startDate must be a valid date.',
                ],
                'endDate' => [
                    'The end date must be after the start date.',
                    'The endDate must be a valid date.',
                ],
            ])
            ->assertJsonFragment([
                'message' => 'Validation Error',
                'success' => false,
            ]);
    }

    public function testStartDateMustBeBeforeEndDate()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-03',
            'endDate' => '2024-09-02',
        ]))
            ->assertJsonValidationErrors([
                'startDate',
                'endDate',
            ])
            ->assertJsonFragment([
                'startDate' => ['The start date must be before the end date.'],
                'endDate' => ['The end date must be after the start date.'],
            ])
            ->assertJsonFragment([
                'message' => 'Validation Error',
                'success' => false,
            ]);
    }

    public function testValidUnitQueryWillPassValidation()
    {
        $query = [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-05',
        ];

        collect(TimeUnitsEnum::cases())
            ->each(function (TimeUnitsEnum $enum) use (&$query) {
                $query['units'] = $enum->value;

                $this->get(route('days-interval', $query))
                    ->assertOk();
            });
    }

    public function testIncorrectUnitsValueWillError()
    {
        $this->get(route('days-interval', [
            'startDate' => '2024-09-02',
            'endDate' => '2024-09-05',
            'units' => 'milleniums',
        ]))
            ->assertJsonValidationErrors([
                'units',
            ])
            ->assertJsonFragment([
                'units' => ['Please choose a valid unit: seconds, minutes, hours, or years, if provided.'],
            ]);
    }
}
