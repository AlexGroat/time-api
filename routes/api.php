<?php

use App\Http\Controllers\Api\CompleteWeekIntervalController;
use App\Http\Controllers\Api\DayIntervalController;
use App\Http\Controllers\Api\WeekDayIntervalController;
use Illuminate\Support\Facades\Route;

Route::get('/days-interval', DayIntervalController::class);

Route::get('/weekdays-interval', WeekDayIntervalController::class);

Route::get('/complete-weeks-interval', CompleteWeekIntervalController::class)
    ->name('complete-weeks-interval');
