<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cedula' => 'string|unique:users,cedula',
            'name' => 'string|max:50',
            'name_02' => 'string|max:50',
            'surname_01' => 'string|max:50',
            'surname_02' => 'string|max:50',
            'birth_date' => 'date',
            'birth_place' => 'string|max:100',
            'sex' => 'string|max:255',
            'nationality' => 'string|max:50',
            'email' => 'string|max:100|unique:users,email',
            'email_verified_at' => 'date',
            'password' => 'string|max:255',
            'remember_token' => 'string|max:100',
            'birth_country' => 'string',
            'current_team_id' => 'string',
            'profile_photo_path' => 'string|max:2048',
        ];
    }
}
