<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')
                ->select(['users.id','users.name', 'users.email', 'users.password']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<td class="dropdown">
                                <div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div>
                                <ul class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="' . url('admin-page/user/' . $data->id . '/edit') . '">
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
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new User();
        $table->name = $request->name;
        $table->email = $request->email;
        $table->password = Hash::make($request->password);

        $table->save();

        return redirect()->route('user.index');
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
        $data = User::find($id);
        return view('admin.user.edit', compact('data'));
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
        $table = User::find($id);

        $table->name = $request->name;
        $table->email = $request->email;
        $table->password = Hash::make($request->password);

        $table->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = User::find($request->id);
        $table->delete();
        return redirect()->route('user.index');
    }
}
