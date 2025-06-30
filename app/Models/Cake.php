<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kue',
        'harga_kue',
        'gambar_kue',
    ];

    /**
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}