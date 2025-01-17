<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialShowForHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Bugungi sana
        $today = Carbon::today();
        return [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "downloads" => $this->downloads,
            "category_id" => $this->category_id,
            "subject_id" => $this->subject_id,
            "size" => $this->size,
            "type" => $this->type,
            "category_name" => $this->category->name ?? null,
            "subject_name" => $this->subject->name ?? null,
            "days_difference" => $today->diffInDays($this->created_at),
            "date" => dateFormat($this->created_at),
            "pages" => MaterialPageForHomeResource::collection($this->pages)
        ];
    }
}
