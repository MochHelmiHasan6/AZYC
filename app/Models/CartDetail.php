<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_details';
    protected $fillable = [
        'produk_id',
        'cart_id',
        'qty',
        'harga',
        'total',
    ];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_id');
    }

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty, $harga)
    {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        $this->attributes['total'] = $itemdetail->total + ($qty * $harga);
        self::save();
    }
}
