<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class SubscriptionHistoryDTO implements DTOInterface
{
    use BaseDTO;

    public $id = null;
    public $user_id;
    public $subscription_id;
    public $payment_id;
    public $start_date;
    public $end_date;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "user_id" => "required|int",
            "subscription_id" => "required|int",
            "payment_id" => "required|int",
            "start_date" => "required",
            "end_date" => "required",
            "responsible_worker" => "required",
        ];
    }
    
}
