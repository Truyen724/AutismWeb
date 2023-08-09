<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL|max:500',
            'phone' => 'required|unique:users,phone,NULL,id,deleted_at,NULL|max:20',
            'password' => 'required|min:6|max:50|same:confirm_password',
            'confirm_password' => 'required|min:6|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('auth.name')]),
            'name.max' => __('validation.max', ['attribute' => __('auth.name'), 'max' => 255]),

            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'email.unique' => __('validation.unique', ['attribute' => 'Email']),
            'email.email' => __('validation.email', ['attribute' => 'Email']),

            'phone.required' => __('validation.required', ['attribute' => __('user.phone')]),
            'phone.unique' => __('validation.unique', ['attribute' => __('user.phone')]),
            'phone.max' => __('validation.max', ['attribute' => __('user.phone'), 'max' => 20]),

            'password.required' => __('validation.required', ['attribute' => __('auth.password')]),
            'password.max' => __('validation.max', ['attribute' => __('auth.password'), 'max' => 50]),
            'password.min' => __('validation.min', ['attribute' => __('auth.password'), 'min' => 6]),
            'password.same' => __('validation.same', ['attribute' => __('auth.password'), 'other' => __('auth.confirm_password')]),

            'confirm_password.required' => __('validation.required', ['attribute' => __('auth.confirm_password')]),
            'confirm_password.max' => __('validation.max', ['attribute' => __('auth.confirm_password'), 'max' => 50]),
            'confirm_password.min' => __('validation.min', ['attribute' => __('auth.confirm_password'), 'min' => 6]),
        ];
    }
}
