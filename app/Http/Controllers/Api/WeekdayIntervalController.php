<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateIntervalRequest;
use App\Services\TimeUnitService;
use Illuminate\Http\JsonResponse;

class WeekdayIntervalController extends Controller
{
    /**
     *  Calculate the time interval in weekdays between two dates and return the result in
     *  specified units or as the number of weekdays.
     */
    public function __invoke(DateIntervalRequest $request): JsonResponse
    {
        $startDate = strtotime($request->validated('startDate'));
        $endDate = strtotime($request->validated('endDate'));

        $weekdaysCount = 0;
        while ($startDate <= $endDate) {
            $dayOfWeek = date('N', $startDate);

            // Check if the day is a weekday (Monday to Friday)
            if ($dayOfWeek < 6) {
                $weekdaysCount++;
            }

            // Move to the next day
            $startDate = strtotime('+1 day', $startDate);
        }

        // Round the number of weekdays
        $roundedWeekdays = round($weekdaysCount);

        $response = null;
        if ($request->validated('units')) {
            $response = (new TimeUnitService(
                (int) $roundedWeekdays * 60 * 60 * 24,
                $request->validated('units')
            ))->unitConversion();

        } else {
            $response = $roundedWeekdays;
        }

        return response()->json([
            'success' => true,
            'message' => 'Operation successful.',
            'data' => $response,
        ]);
    }
}
