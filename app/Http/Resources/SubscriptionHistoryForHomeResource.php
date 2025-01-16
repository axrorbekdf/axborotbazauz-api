<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class SubscriptionHistoryForHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $today = Carbon::today();

        return [
            "status" => $today->between(Carbon::parse($this->start_date), Carbon::parse($this->end_date)),
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "date" => dateFormat($this->created_at),
            "subscription" => SubscriptionForHomeResource::make($this->subscription),
            "payment" => $this->payment->name ?? null,
        ];
    }
}
