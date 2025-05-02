<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

class StoreLevelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('super-admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255'],
            'min_age' => [
                'required',
                'numeric',
                'min:0',
                'max:25',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value > $this->input('max_age')) {
                        $fail("The min_age must be greater than max_age");
                    }
                },
            ],
            'max_age' => ['required', 'numeric', 'min:0', 'max:25'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
