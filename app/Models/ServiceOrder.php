<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
