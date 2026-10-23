<?php

namespace App\Http\Requests\Admin;

use App\Enums\EmailType;
use App\Services\Mail\EmailSettings;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates an email template for saving, previewing or a test send. The
 * route's {type} decides which fields apply.
 */
class UpdateEmailTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['enabled' => $this->boolean('enabled')]);
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        $singleLine = 'not_regex:/[\r\n]/';

        $rules = [
            'subject' => ['required', 'string', 'max:200', $singleLine],
            'heading' => ['nullable', 'string', 'max:200'],
            'body' => ['required', 'string', 'max:20000'],
            'footer' => ['nullable', 'string', 'max:2000'],
            'button_text' => ['nullable', 'string', 'max:80', $singleLine],
            'test_recipient' => ['nullable', 'email:rfc,filter', 'max:255', $singleLine],
        ];

        if ($this->emailType() === EmailType::CustomerAcknowledgement) {
            $rules += [
                'enabled' => ['boolean'],
                'from_name' => ['nullable', 'string', 'max:120', $singleLine],
                'company_details' => ['nullable', 'string', 'max:1000'],
                'button_url' => ['nullable', 'required_with:button_text', 'url:http,https', 'max:500'],
            ];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'button_url.required_with' => 'Add a button URL, or clear the button text.',
        ];
    }

    public function emailType(): EmailType
    {
        return $this->route('type');
    }

    /**
     * The submitted template fields, keyed like {@see EmailSettings::template()}.
     *
     * @return array<string, string>
     */
    public function template(): array
    {
        return collect(EmailSettings::templateFields($this->emailType()))
            ->mapWithKeys(fn (string $field) => [$field => (string) $this->validated($field, '')])
            ->all();
    }
}
