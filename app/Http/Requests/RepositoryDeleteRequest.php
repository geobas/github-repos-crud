<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepositoryDeleteRequest extends FormRequest
{
    use HandlesFailedValidation;

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
            'owner' => 'required|string',
            'name' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'owner.required' => 'An owner is required',
            'owner.string' => 'Owner must be a string',
            'name.required' => 'A name is required',
            'name.string' => 'Name must be a string',
        ];
    }

    /**
     * Return validated owner parameter.
     */
    public function getOwner(): string
    {
        return $this->validated('owner');
    }

    /**
     * Return validated name parameter.
     */
    public function getName(): string
    {
        return $this->validated('name');
    }
}
