<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'contact_no' => ['required'],
            /*'utility_type_id' => ['required', 'integer'],
            'consumption' => ['required', 'sometimes'],
            'amount' => ['required'],
            'bill_image' => ['sometimes', 'required', 'image'],
            'reading' => ['sometimes', 'integer'],
            'period' => ['required', 'date']*/
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Full Name is required'
        ];
    }
}
