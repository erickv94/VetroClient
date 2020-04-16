<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdate extends FormRequest
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
        $id = $this->route('id');

        return [
            'name'=>'required',
            'username'=>'nullable|unique:users,username,' . $id ,
            'email'=>'required|email|unique:users,email,' . $id ,
            'permissions'=>'required|array|min:1',
            'password' => 'nullable|min:6',
        ];
    }
}
