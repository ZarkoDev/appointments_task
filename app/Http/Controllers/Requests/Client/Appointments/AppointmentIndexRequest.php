<?php

namespace App\Http\Controllers\Requests\Client\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentIndexRequest extends FormRequest
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
            'egn' => ['sometimes', 'nullable', 'numeric', 'digits:10'],
            'from' => ['sometimes', 'nullable',  'date_format:"Y-m-d"'],
            'to' => ['sometimes', 'nullable',  'date_format:"Y-m-d"'],
            'user_id' => ['sometimes', 'nullable', 'numeric', 'exists:users,id'],
        ];
    }
}
