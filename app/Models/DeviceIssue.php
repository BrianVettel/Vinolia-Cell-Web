<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceIssue extends Model
{
    public function deviceBrand()
    {
        return $this->belongsTo(DeviceBrand::class);
    }
}
