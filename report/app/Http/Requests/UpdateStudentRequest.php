<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:225',
            'course' => 'nullable|string|max:225',
            'office_id' => 'required|exists:offices,id',
            'contactNumber' => 'nullable|numeric',
            'dateStart' => 'nullable|date',
            'hoursOfDuty' => 'nullable|integer|min:0',
            'daysOfDuty' => 'nullable|integer|min:0',
            'endOfDuty' => 'nullable|date',
            'date' => 'nullable|date',
        ];
    }
}
