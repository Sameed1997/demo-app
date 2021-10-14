<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => ['bail','required','string','max:20','min:3'],
            'last_name' => ['bail','required','string','max:20','min:3'],
            'email' => ['bail','sometimes','email'],
            'phone' => ['sometimes','string','max:15','min:3'],
            'phone' => ['bail','sometimes','url']
        ];
    }
}
