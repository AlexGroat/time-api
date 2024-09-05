<?php

namespace App\Http\Controllers\Api;

use App\Enums\TimeUnitsEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DateIntervalRequest;
use App\Services\TimeUnitService;
use Illuminate\Http\JsonResponse;

class CompleteWeekIntervalController extends Controller
{
    /**
     * Handles the calculation of the interval between two dates in weeks or specified time units.
     * If the 'precision' key is set, the result will be rounded to 3 decimal
     * places.
     */
    public function __invoke(DateIntervalRequest $request): JsonResponse
    {
        $startDate = strtotime($request->validated('startDate'));
        $endDate = strtotime($request->validated('endDate'));

        $intervalInSeconds = (int) $endDate - $startDate;

        $request->validated('precision')
            ? $completeWeeks = round($intervalInSeconds / (60 * 60 * 24 * 7), 3)
            : $completeWeeks = floor($intervalInSeconds / (60 * 60 * 24 * 7));

        if ($request->validated('units')) {
            $timeInSeconds = $completeWeeks * (60 * 60 * 24 * 7);
            $response = (new TimeUnitService(
                (int) $timeInSeconds,
                $request->validated('units')
            ))->unitConversion();

            if ($request->validated('units') === TimeUnitsEnum::YEARS->value) {
                $response = ceil($response);
            }
        } else {
            $response = $completeWeeks;
        }

        return response()->json([
            'success' => true,
            'message' => 'Operation successful.',
            'data' => $response,
        ]);
    }
}
