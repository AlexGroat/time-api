<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateIntervalRequest;
use DateTime;
use Illuminate\Http\JsonResponse;

class DayIntervalController extends Controller
{
    /**
     * Return the number of days between the
     */
    public function __invoke(DateIntervalRequest $request): JsonResponse
    {
        $date = new DateTime($request->validated('startDate'));

        return response()->json($date);

    }
}
