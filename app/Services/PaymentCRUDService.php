<?php

namespace App\Services;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentCRUDService extends CRUDService
{
    protected $modelClass = Payment::class;
    protected $modelResourceClass = PaymentResource::class;
    protected $withModels = [];
}
