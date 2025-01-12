<?php

namespace App\Http\Resources;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            "title" => $this->title,
            "slug" => $this->slug,
            "downloads" => $this->downloads,
            "category_id" => $this->category_id,
            "subject_id" => $this->subject_id,
            "path" => $this->path,
            "size" => $this->size,
            "type" => $this->type,
            "status" => $this->status,
            "responsible_worker" => $this->responsible_worker,
            "created_at" => dateFormat($this->created_at),
            "updated_at" => dateFormat($this->updated_at),
            "category" => CategoryForRelationResource::make($this->category),
            "subject" => SubjectForRelationResource::make($this->subject),
            "pages" => MaterialPageResource::collection($this->pages),
        ];
    }
}
