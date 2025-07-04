<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cake_id',
        'tanggal_pemesanan',
        'jumlah_pemesanan',
        'total_price',
        'catatan',
        'status',
    ];

    /**
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     */
    public function cake()
    {
        return $this->belongsTo(Cake::class);
    }
}