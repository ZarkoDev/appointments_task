<?php

namespace App\Http\Controllers\Requests\Client\Appointments;

use App\Enums\NotificationMethodEnum;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:30'],
            'last_name' => ['required', 'string', 'min:3', 'max:30'],
            'notification_method' => ['required', 'exists:notification_methods,slug'],
            'time' => ['required',  'date_format:"Y-m-d\TH:i"', 'after_or_equal:today'],
            'email' => ['required_if:notification_method,'. NotificationMethodEnum::MAIL, 'nullable', 'email'],
            'phone' => ['required_if:notification_method,'. NotificationMethodEnum::SMS, 'nullable', 'numeric', 'digits:10'],
            'description' => ['sometimes', 'nullable', 'string', 'min:5', 'max:500'],
        ];
    }
}
