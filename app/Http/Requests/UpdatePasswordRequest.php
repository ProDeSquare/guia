<?php

namespace App\Http\Requests;

use App\Rules\MatchesOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => [new MatchesOldPassword],
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
