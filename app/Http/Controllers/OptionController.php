<?php

namespace App\Http\Controllers;

use App\Models\DeviceBrand;
use App\Models\DeviceIssue;
use App\Models\OrderStatus;

class OptionController extends Controller
{
    public function getIssues()
    {
        return DeviceIssue::all();
    }

    public function getBrands()
    {
        return DeviceBrand::all();
    }

    public function getStatus()
    {
        return OrderStatus::STATUS;
    }
}
