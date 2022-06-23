<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $jasa = Produk::count();
        $pesanan = Transaksi::count();

        $januari = Transaksi::whereMonth('created_at', '01')->count();
        $februari = Transaksi::whereMonth('created_at', '02')->count();
        $maret = Transaksi::whereMonth('created_at', '03')->count();
        $april = Transaksi::whereMonth('created_at', '04')->count();
        $mei = Transaksi::whereMonth('created_at', '05')->count();
        $juni = Transaksi::whereMonth('created_at', '06')->count();
        $juli = Transaksi::whereMonth('created_at', '07')->count();
        $agustus = Transaksi::whereMonth('created_at', '08')->count();
        $september = Transaksi::whereMonth('created_at', '09')->count();
        $oktober = Transaksi::whereMonth('created_at', '10')->count();
        $november = Transaksi::whereMonth('created_at', '11')->count();
        $desember = Transaksi::whereMonth('created_at', '12')->count();

        return view('admin.dashboard.index', compact('user', 'jasa', 'pesanan', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'));
    }
}
