<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "products";
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'image', 'description', 'price', 'slug'];
}
