<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRegisterRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:25', new FullNameRule()],
            'username' => 'required|unique:students|min:3|max:25|alpha_dash',
            'roll_no' => 'required|integer|unique:students',
            'password' => 'required|min:8|max:255',
        ];
    }
}
