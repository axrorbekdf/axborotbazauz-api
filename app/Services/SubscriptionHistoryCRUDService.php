<?php

namespace App\Services;

use App\Http\Resources\SubscriptionHistoryResource;
use App\Models\SubscriptionHistory;

class SubscriptionHistoryCRUDService extends CRUDService
{
    protected $modelClass = SubscriptionHistory::class;
    protected $modelResourceClass = SubscriptionHistoryResource::class;
    protected $withModels = ["user","subscription","payment"];
}
