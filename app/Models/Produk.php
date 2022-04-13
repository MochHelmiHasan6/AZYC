<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "products";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'name', 'image', 'description', 'price', 'slug'];
}
