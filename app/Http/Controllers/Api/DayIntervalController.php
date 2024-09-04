<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateIntervalRequest;
use App\Services\TimeUnitService;
use Illuminate\Http\JsonResponse;

class DayIntervalController extends Controller
{
    /**
     * Calculate the time interval between two dates and return the result in
     * specified units or days.
     */
    public function __invoke(DateIntervalRequest $request): JsonResponse
    {
        $startDate = strtotime($request->validated('startDate'));
        $endDate = strtotime($request->validated('endDate'));

        $intervalInSeconds = (int) $endDate - $startDate;

        if ($request->validated('units')) {
            $response = (new TimeUnitService(
                $intervalInSeconds,
                $request->validated('units')
            ))->unitConversion();
        } else {
            $response = round($intervalInSeconds / 86400, 2); // seconds in a
            // day
        }

        return response()->json([
            'success' => true,
            'message' => 'Operation successful.',
            'data' => $response,
        ]);
    }
}
