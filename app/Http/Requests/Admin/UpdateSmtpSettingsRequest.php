<?php

namespace App\Http\Requests\Admin;

use App\Rules\PublicSmtpHost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSmtpSettingsRequest extends FormRequest
{
    /**
     * Route access is already limited to administrators by the `admin` middleware.
     */
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'smtp_enabled' => $this->boolean('smtp_enabled'),
            'remove_password' => $this->boolean('remove_password'),
            'host' => is_string($this->host) ? trim($this->host) : $this->host,
        ]);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $singleLine = 'not_regex:/[\r\n]/';

        return [
            'smtp_enabled' => ['boolean'],
            'host' => ['required_if:smtp_enabled,true', 'nullable', 'string', 'max:255', new PublicSmtpHost],
            'port' => ['required_if:smtp_enabled,true', 'nullable', 'integer', Rule::in(config('mail.dynamic_smtp.allowed_ports'))],
            'encryption' => ['required', Rule::in(['tls', 'ssl', 'none'])],
            'username' => ['nullable', 'string', 'max:255', $singleLine],
            'password' => ['nullable', 'string', 'max:255', $singleLine],
            'remove_password' => ['boolean'],
            'from_address' => ['required_if:smtp_enabled,true', 'nullable', 'email:rfc', 'max:255', $singleLine],
            'from_name' => ['nullable', 'string', 'max:120', $singleLine],
            'timeout' => ['nullable', 'integer', 'min:5', 'max:120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'port.in' => 'The port must be one of: '.implode(', ', config('mail.dynamic_smtp.allowed_ports')).'.',
            'host.required_if' => 'An SMTP host is required when SMTP is enabled.',
            'port.required_if' => 'An SMTP port is required when SMTP is enabled.',
            'from_address.required_if' => 'A sender email address is required when SMTP is enabled.',
        ];
    }
}
