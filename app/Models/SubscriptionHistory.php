<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    use HasFactory, Searchable, Filterable;

    protected $fillable = [
        "user_id",
        "subscription_id",
        "payment_id",
        "start_date",
        "end_date",
        "responsible_worker",
    ];

    protected $searchable = [
        "user.name",
        "subscription.name",
        "payment.name",
        "start_date",
        "end_date",
        // "responsible_worker",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
