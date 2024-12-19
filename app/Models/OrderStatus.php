<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    const STATUS = [
        'pending' => 'Pending',
        'processed' => 'Diproses',
        'rejected' => 'Ditolak oleh pihak service',
        'price_apply' => 'Pengajuan harga',
        'waiting_for_approval' => 'Menunggu persetujuan',
        'approved_by_customer' => 'Disetujui oleh pelanggan',
        'rejected_by_customer' => 'Ditolak oleh pelanggan',
        'fixing' => 'Perbaikan',
        'completed' => 'Selesai',
    ];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }
}
