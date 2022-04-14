<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Yajra\Datatables\Datatables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('produks')
                ->select(['produks.id','produks.name', 'produks.image', 'produks.description', 'produks.price']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<td class="dropdown">
                                <div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div>
                                <ul class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="' . url('admin-page/produk/' . $data->id . '/edit') . '">
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
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.produk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('tes');
        $table = new Produk();
        $table->id = Str::random(10);
        $table->name = $request->name;
        $table->description = $request->description;
        $table->price = $request->price;
        $table->image = $request->image;
        $table->slug = Str::slug($request->name);

        $image_name = 'image' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $image_name);
        $table->image = 'images/' . $image_name;

        $table->save();

        // return redirect();
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
        $data = Produk::find($id);
        return view('admin.produk.edit', compact('data'));
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
        $table = Produk::find($id);

        $table->name = $request->name;
        $table->image = $request->image;
        $table->description = $request->description;
        $table->price = $request->price;
        $table->slug = Str::slug($request->name);

        if (!empty($request->image)) {
            $image_name = 'image' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $image_name);
            $table->image = 'images/' . $image_name;
        } else {
            $table->image = $table->image;
        }

        $table->save();

        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = Produk::find($request->id);
        $table->delete();
        return redirect()->route('produk.index');
    }
}
