<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialPageResource extends JsonResource
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
            "material_id" => $this->material_id,
            "number" => $this->number,
            "content" => $this->content,
            // "previewPath" => $this->previewPath,
            "previewPath" => preg_replace('/(\.\w+)$/', '-watermarked$1', $this->previewPath),
            "responsible_worker" => $this->responsible_worker,
            "created_at" => dateFormat($this->created_at),
            "updated_at" => dateFormat($this->updated_at),
        ];
    }
}
