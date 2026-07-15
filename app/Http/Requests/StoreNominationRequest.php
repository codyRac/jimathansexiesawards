<?php

namespace App\Http\Requests;

use App\Support\Xies;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNominationRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nominee_x_handle' => ltrim((string) $this->string('nominee_x_handle'), '@'),
            'nominator_x_handle' => ltrim((string) $this->string('nominator_x_handle'), '@') ?: null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nominator_name' => ['required', 'string', 'max:255'],
            'nominator_email' => ['required', 'email', 'max:255'],
            'nominator_x_handle' => ['nullable', 'string', 'max:255'],
            'self_nomination' => ['boolean'],
            'nominee_name' => ['required', 'string', 'max:255'],
            'nominee_x_handle' => ['required', 'string', 'max:255'],
            'show_name' => ['nullable', 'string', 'max:255'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['string', Rule::in(Xies::categories())],
            'reason' => ['required', 'string', 'max:5000'],
            'links' => ['nullable', 'string', 'max:2000'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'mimes:mp4,mov,m4v,mp3,m4a,wav,aac,png,jpg,jpeg,webp,pdf', 'max:51200'],
            'payment_method' => ['required', Rule::in(['paypal', 'card'])],
            'payment_reference' => ['nullable', 'string', 'max:255'],
            'terms' => ['required', 'accepted'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'categories.required' => 'Choose at least one award category.',
            'categories.*.in' => 'One of the selected categories is not a valid award category.',
            'attachments.max' => 'You may upload up to 5 supporting files.',
            'attachments.*.max' => 'Each supporting file must be 50MB or smaller.',
            'attachments.*.mimes' => 'Supporting files must be video, audio, image, or PDF.',
            'terms.accepted' => 'You must accept the nomination terms to submit.',
        ];
    }
}
