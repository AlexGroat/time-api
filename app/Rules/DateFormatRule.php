<?php

namespace App\Rules;

use Closure;
use DateTime;
use Illuminate\Contracts\Validation\ValidationRule;

class DateFormatRule implements ValidationRule
{
    /**
     * Validates that the attribute is a valid date.
     *
     * @param  string  $attribute  The name of the attribute.
     * @param  mixed  $value  The value to validate.
     * @param  Closure  $fail  The callback to trigger on failure.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $date = new DateTime($value);
        } catch (\Exception $e) {
            $fail('The '.$attribute.' must be a valid date.');

            return;
        }
    }
}
