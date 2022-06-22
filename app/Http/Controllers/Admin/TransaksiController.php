<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use \Yajra\Datatables\Datatables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                ->rawColumns(['action', 'paid_total'])
                ->make(true);
        }
        return view('admin.transaksi.index');
    }

    public function report()
    {
        $countData = DB::table('transaksis')
            ->leftJoin('users', 'transaksis.user_id', '=', 'users.id')
            // ->where(kolomtanggal , '>=', request('from_date'))  
            // ->where(kolomtanggal , '<=', request('to_date'))  
            ->count();

        if (request('from_date') > request('to_date')) {
            return redirect()->route('transaksi.index');
        } else if (!($countData > 0)) {
            return redirect()->route('transaksi.index');
        } else {
            return Excel::download(new TransaksiExport(request('from_date'), request('to_date')), 'Laporan Transaksi ' . request('from_date') . ' - ' . request('to_date') . '.xlsx');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.transaksi.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $table = new Transaksi();
        $table->id = 'transaksi-' . Str::random(3) . '-' . Carbon::now()->format('YmdHis');
        $table->user_id = $request->user_id;
        $table->paid_total = $request->paid_total;
        $table->status = $request->status;
        $table->address = $request->address;
        $table->no_hp = $request->no_hp;

        $table->save();

        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $data = Transaksi::find($id);
        return view('admin.transaksi.edit', compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Transaksi::find($id);
        $table->user_id = $request->user_id;
        $table->paid_total = $request->paid_total;
        $table->status = $request->status;
        $table->address = $request->address;
        $table->no_hp = $request->no_hp;

        $table->save();

        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = Transaksi::find($request->id);
        $table->delete();
        return redirect()->route('transaksi.index');
    }
}
