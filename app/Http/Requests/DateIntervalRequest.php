<?php

namespace App\Http\Requests;

use App\Enums\TimeUnitsEnum;
use App\Rules\DateFormatRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DateIntervalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'startDate' => str_replace(' ', '+', $this->input('startDate')),
            'endDate' => str_replace(' ', '+', $this->input('endDate')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'startDate' => ['required', new DateFormatRule, 'before:endDate'],
            'endDate' => ['required', new DateFormatRule, 'after:startDate'],
            'units' => ['nullable', 'string', Rule::in(collect(TimeUnitsEnum::cases())->toArray())],
        ];

        if ($this->routeIs('complete-weeks-interval')) {
            $rules['precision'] = ['nullable', 'in:true'];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'startDate.required' => 'The start date is required. Please provide one.',
            'startDate.before' => 'The start date must be before the end date.',

            'endDate.required' => 'The end date is required. Please provide one.',
            'endDate.after' => 'The end date must be after the start date.',

            'units.in' => 'Please choose a valid unit: seconds, minutes, hours, or years, if provided.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'errors' => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
