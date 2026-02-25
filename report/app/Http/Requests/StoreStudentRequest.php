<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'studentNames' => 'required|string',
            'studentCourse' => 'nullable|string|max:225',
            'office_id' => 'required|exists:offices,id',
            'studentContact' => 'nullable|integer|max:20',
            'dateStart' => 'nullable|date',
            'hoursOfDuty' => 'nullable|integer|max:20',
            'daysOfDuty' => 'nullable|integer|max:20',
            'endOfDuty' => 'nullable|date',
            'school_id' => 'required|exists:schools,id',
        ];
    }
}
