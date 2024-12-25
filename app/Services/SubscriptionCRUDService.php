<?php

namespace App\Services;

use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionCRUDService extends CRUDService
{
    protected $modelClass = Subscription::class;
    protected $modelResourceClass = SubscriptionResource::class;
    protected $withModels = [];
}
