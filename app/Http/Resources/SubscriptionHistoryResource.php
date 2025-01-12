<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionHistoryResource extends JsonResource
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
            "user_id" => $this->user_id,
            "subscription_id" => $this->subscription_id,
            "payment_id" => $this->payment_id,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "responsible_worker" => $this->responsible_worker,
            "created_at" => dateFormat($this->created_at),
            "updated_at" => dateFormat($this->updated_at),
            "user" => UserResource::make($this->user),
            "subscription" => SubscriptionResource::make($this->subscription),
            "payment" => PaymentResource::make($this->payment),
        ];
    }
}
