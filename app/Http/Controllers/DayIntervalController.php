<?php

namespace App\Http\Controllers;

use App\Enums\TimeUnitsEnum;
use App\Http\Requests\DateIntervalRequest;
use Illuminate\Http\JsonResponse;

class DayIntervalController extends Controller
{
    /**
     * Return the number of days between the
     */
    public function __invoke(DateIntervalRequest $request): JsonResponse
    {
        $startDate = strtotime($request->validated('startDate'));
        $endDate = strtotime($request->validated('endDate'));

        $intervalInSeconds = (int) $endDate - $startDate;

        $response = null;
        if ($request->validated('units')) {
            if ($request->validated('units') ===
                TimeUnitsEnum::SECONDS->value) {
                $response = $intervalInSeconds;
            }

            if ($request->validated('units') ===
                TimeUnitsEnum::MINUTES->value) {
                $response = $intervalInSeconds / 60; // seconds in a minute
            }

            if ($request->validated('units') === TimeUnitsEnum::HOURS->value) {
                $response = $intervalInSeconds / 3600; // seconds in an hour
            }

            if ($request->validated('units') === TimeUnitsEnum::YEARS->value) {
                $response = $intervalInSeconds / 31536000; // seconds in a year
            }

        } else {
            $response = $intervalInSeconds / 86400; // seconds in a day
        }

        return response()->json($response);
    }
}
