<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $cart = CartDetail::leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
            ->select('cart_details.id as sku', 'produks.name as name', 'cart_details.qty as quantity', 'cart_details.harga as price', 'cart_details.cart_id as cart_id',)
            ->where('cart_details.cart_id', $request->cart_id)
            ->get();
        foreach ($cart as $object) {
            $order_items[] = $object->toArray();
        }

        $apiKey       = config('tripay.api_key');
        $privateKey   = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');
        $merchantRef  = 'INV-' . time();
        $method       =  $request->channel;
        $amount  = $request->total;
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $request->nama_penerima,
            'customer_email' => Auth::user()->email,
            'customer_phone' => $request->no_hp,
            'order_items'    => $order_items,
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        echo empty($error) ? $response : $error;
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

    public function checkout(Request $request, $id)
    {
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('status_cart', 'cart')
            ->first();


        $carts = CartDetail::leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
            ->select('cart_details.id as id', 'cart_details.cart_id as cart_id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
            ->where('cart_details.cart_id', $id)
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
            return view('user.cart.checkout', compact('channels', 'id'), $data)->with('no', 1);
        } else {
            return abort('404');
        }
    }
}
