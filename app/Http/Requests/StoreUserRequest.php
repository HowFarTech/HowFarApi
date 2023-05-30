<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
        //validation rules for storing users
        'name' => ['required','string'],
        'email' => ['nullable','email','unique:users,email'],
        'countryCode'=> ['required','string'],
        'phone'=> ['required','string'],
        'age'=> ['nullable','string'],
        'bio'=> ['nullable','string'],
        'image'=> ['nullable','string'],
        'serverTimeFetchHelper'=> ['nullable','string'],
        'gender'=> ['required','string'],
        'isAdmin'=> ['boolean','default'=>false],
        'isSuperAdmin' =>['boolean','default'=>false],
        ];
    }
}
