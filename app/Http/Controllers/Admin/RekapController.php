<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\Datatables\Datatables;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transaksis')
                ->leftJoin('users', 'transaksis.user_id', '=', 'users.id')
                ->select(['transaksis.id', 'users.name as user_name',  'transaksis.paid_total', 'transaksis.status', 'transaksis.address', 'transaksis.no_hp']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<td class="dropdown">
                                <div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div>
                                <ul class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="' . url('admin-page/transaksi/' . $data->id . '/edit') . '">
                                        <li>
                                            <i class="ik ik-edit" style="color: green;font-size:16px;padding-right:5px"></i>
                                            <span style="font-size:14px"> Edit</span>
                                        </li>
                                    </a>
                                    <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#exampleModal" data-id=' . $data->id . '>
                                        <li>
                                            <i class="ik ik-trash-2" style="color: red;font-size:16px;padding-right:5px"></i>
                                            <span style="font-size:14px"> Hapus</span>
                                        </li>
                                    </a>
                                </ul>
                            </td>';
                    return $btn;
                })
                ->addColumn('paid_total', function ($data) {
                    $btn = 'Rp. ' . number_format($data->paid_total, 2);
                    return $btn;
                })
                ->rawColumns(['action','paid_total'])
                ->make(true);
        }
        return view('admin.transaksi.index');
    }
}
