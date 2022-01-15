<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateProfileRequest extends FormRequest
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
            'bio' => 'nullable|min:10|max:60',
            'requirements' => 'nullable|max:255',
            'supervise_count' => 'required|min:0|max:4|integer',
            'co_supervise_count' => 'required|min:0|max:4|integer',
            'whatsapp' => 'required',
        ];
    }
}
