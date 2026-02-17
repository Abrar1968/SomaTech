<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:255'],
            'service_interest' => ['required', 'string', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:20'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please tell us your name.',
            'email.required' => 'We need your email to get back to you.',
            'email.email' => 'Please provide a valid email address.',
            'service_interest.required' => 'Please select a service you\'re interested in.',
            'message.required' => 'Please share some details about your project.',
            'message.min' => 'Please provide at least 20 characters in your message.',
        ];
    }
}
