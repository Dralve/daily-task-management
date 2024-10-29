<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:100',
            'description' => 'sometimes|string',
            'due_date' => 'sometimes|date_format:Y-m-d|after_or_equal:today'
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'due_date' => 'DueDate',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'title.string' => 'The :attribute Field must be of Type String.',
            'title.max' => 'The :attribute may not be Greater Than :max Characters.',
            'description.string' => 'The :attribute must be of Type String.', 'type.required' => 'The :attribute Field is Required.',
            'due_date.date' => 'The :attribute must be a Valid Date.',
            'due_date.after_or_equal' => 'The :attribute must be Today or a Future Date.',
        ];
    }
}
