<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "login" => $this->login,
            "responsible_worker" => $this->responsible_worker,
            "is_active" => $this->is_active,
            "created_at" => dateFormat($this->created_at),
            "updated_at" => dateFormat($this->updated_at),
        ];
    }
}
