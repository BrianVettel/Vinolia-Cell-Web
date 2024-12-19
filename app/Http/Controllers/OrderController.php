<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getCurrentCustomerOrders()
    {
        return Auth::user()->serviceOrders;
    }

    public function createOrder(Request $request)
    {
        $order = Auth::user()->serviceOrders->create($request->all());
        return $order;
    }

    public function getCustomerOrderDetail(ServiceOrder $order)
    {
        $statuses = $order->statuses->map(function ($status) {
            return [
                'id' => $status->id,
                'status' => $status->status,
                'status_message' => OrderStatus::STATUS[$status->status] ?? $status->status,
                'created_at' => $status->created_at
            ];
        });

        return [
            'order' => $order,
            'statuses' => $statuses
        ];
    }

    public function approveOrder(ServiceOrder $order)
    {
        $order->status = 'approved';
        $order->save();

        OrderStatus::insert([
            [
                'service_order_id' => $order->id,
                'status' => 'approved_by_customer'
            ],
            [
                'service_order_id' => $order->id,
                'status' => 'fixing'
            ]
        ]);

        return $order;
    }

    public function declineOrder(ServiceOrder $order)
    {
        $order->status = 'declined';
        $order->save();

        OrderStatus::insert([
            'service_order_id' => $order->id,
            'status' => 'declined_by_customer'
        ]);

        return $order;
    }

    public function getAllOrders()
    {
        return ServiceOrder::all();
    }

    public function proceedOrder(ServiceOrder $order, Request $request)
    {
        $order->price = $request->price;
        $order->suggested_return_date = $request->suggested_return_date;
        $order->suggested_return_time = $request->suggested_return_time;

        $order->save();

        OrderStatus::insert([
            [
                'service_order_id' => $order->id,
                'status' => 'price_apply'
            ],
            [
                'service_order_id' => $order->id,
                'status' => 'waiting_for_approval'
            ]
        ]);

        return $order;
    }

    public function updateOrderStatus(ServiceOrder $order, Request $request)
    {
        $status = OrderStatus::insert([
            'service_order_id' => $order->id,
            'status' => $request->status
        ]);

        return $status;
    }

    public function getCustomerOrders(ServiceOrder $order)
    {
        return $order->where('customer_id', $order->customer_id)->get();
    }
}
