<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionHistoryForHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "created_at" => dateFormat($this->created_at),
            "subscription" => SubscriptionForHomeResource::make($this->subscription),
            "payment" => $this->payment->name ?? null,
        ];
    }
}
