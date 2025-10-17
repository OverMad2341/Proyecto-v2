<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cedula' => $this->cedula,
            'name' => $this->name,
            'name_02' => $this->name_02,
            'surname_01' => $this->surname_01,
            'surname_02' => $this->surname_02,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'sex' => $this->sex,
            'nationality' => $this->nationality,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'birth_country' => $this->birth_country,
            'current_team_id' => $this->current_team_id,
            'profile_photo_path' => $this->profile_photo_path,
        ];
    }
}
