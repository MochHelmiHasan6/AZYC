<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $itemuser = $request->user();//ambil data user
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('status_cart', 'cart')
            ->first();

        $carts = CartDetail::leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
            ->select('cart_details.id as id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
            ->get();
            $total = 0;
            foreach ($carts as $c) {
                $total += $c->total;
            }
        $itemcart = CartDetail::leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
            ->select('cart_details.id as id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
            ->get();

        // dd($itemcart);
        $data = array('title' => 'Shopping Cart', 'itemcart' => $itemcart, 'cart' => $cart, 'total' => $total,);

        return view('user.cart.index', $data)->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
    public function kosongkan($id)
    {
        $itemcart = Cart::findOrFail($id);
        $itemcart->detail()->delete(); //hapus semua item di cart detail
        return back()->with('success', 'Cart berhasil dikosongkan');
    }

    public function checkout(Request $request)
    {
        // $itemuser = $request->user();
        // $itemcart = Cart::where('user_id', $itemuser->id)
        //                 ->where('status_cart', 'cart')
        //                 ->first();
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('status_cart', 'cart')
            ->first();

        $carts = CartDetail::leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
            ->select('cart_details.id as id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
            ->get();
            $total = 0;
            foreach ($carts as $c) {
                $total += $c->total;
            }
        $itemcart = CartDetail::leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
            ->select('cart_details.id as id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
            ->get();
        if ($itemcart) {
            $data = array('title' => 'Shopping Cart', 'itemcart' => $itemcart, 'cart' => $cart, 'total' => $total,);
            return view('user.cart.checkout', $data)->with('no', 1);
        } else {
            return abort('404');
        }
    }
}
