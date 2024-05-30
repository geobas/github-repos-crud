<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepositoryUpdateRequest extends FormRequest
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
            'old_name' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'is_private' => 'required|boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_private' => $this->toBoolean($this->is_private),
        ]);
    }

    /**
     * Convert to boolean.
     */
    private function toBoolean(?string $booleable): ?bool
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
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
            'new_name.required' => 'A new name is required',
            'new_name.string' => 'New name must be a string',
            'name.required' => 'A name is required',
            'name.string' => 'Name must be a string',
            'description.required' => 'A description is required',
            'description.string' => 'Description must be a string',
            'is_private.required' => 'A visibility is required',
        ];
    }
}
