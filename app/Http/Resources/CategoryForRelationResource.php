<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryForRelationResource extends JsonResource
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
            "slug" => $this->slug,
            "count" => $this->count,
            "responsible_worker" => $this->responsible_worker,
            "created_at" => dateFormat($this->created_at),
            "updated_at" => dateFormat($this->updated_at),
        ];
    }
}
