<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksis";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'user_id', 'reference', 'merchant_ref', 'paid_total', 'status', 'address', 'no_hp'];

    public function getData($from_date, $to_date)
    {
        $data = DB::table('transaksis')
            ->leftJoin('users', 'transaksis.user_id', '=', 'users.id')
            ->select('transaksis.id', 'users.name as user_name', 'transaksis.reference', 'transaksis.merchant_ref', 'transaksis.paid_total', 'transaksis.status', 'transaksis.address', 'transaksis.no_hp', 'transaksis.created_at')
            // ->where(kolomtanggal , '>=', $from_date)
            // ->where(kolomtanggal , '<=', $to_date)
            ->get();
        return $data;
    }
}
