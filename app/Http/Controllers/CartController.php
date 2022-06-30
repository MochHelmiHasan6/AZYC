<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
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

        $countcart = Cart::where('user_id', Auth::user()->id)
        ->where('status_cart', 'cart')
        ->count();

        $carts = CartDetail::leftJoin('carts', 'cart_details.cart_id', '=', 'carts.id')
        ->leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
        ->select('cart_details.id as id', 'carts.id as cart_id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
        ->where('carts.status_cart', 'cart')
        ->get();
        $total = 0;
        foreach ($carts as $c) {
            $total += $c->total;
        }
        $itemcart = CartDetail::leftJoin('carts', 'cart_details.cart_id', '=', 'carts.id')
        ->leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
        ->select('cart_details.id as id', 'carts.id as cart_id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
        ->where('carts.status_cart', 'cart')
        ->get();

        // dd($itemcart);
        $data = array('title' => 'Shopping Cart', 'itemcart' => $itemcart, 'cart' => $cart, 'total' => $total, 'countcart' => $countcart);

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
        $data = json_decode($response);


        // add to database
        $table = new Transaksi();
        $table->id = 'transaksi-' . Str::random(3) . '-' . Carbon::now()->format('YmdHis');
        $table->user_id = Auth()->user()->id;
        $table->reference = $data->data->reference;
        $table->merchant_ref = $data->data->merchant_ref;
        $table->paid_total = $request->total;
        $table->status = $data->data->status;
        $table->address = $request->alamat;
        $table->no_hp = $request->no_hp;

        if($table->save()){
            Cart::where('user_id', '=', Auth::user()->id)
                    ->where('status_cart', '=', 'cart')
                    ->update(['status_cart' => 'checkout']);
        }


        return redirect()->route('detailpembayaran', [
            'reference' => $data->data->reference,
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Cart  $cart
    * @return \Illuminate\Http\Response
    */
    public function show(Cart $cart)
    {

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
        $itemcart = CartDetail::leftJoin('carts', 'cart_details.cart_id', '=', 'carts.id')
        ->leftJoin('produks', 'cart_details.produk_id', '=', 'produks.id')
        ->select('cart_details.id as id', 'carts.id as cart_id', 'produks.name as name', 'cart_details.qty as qty', 'cart_details.harga as harga', 'cart_details.total as total')
        ->where('carts.status_cart', 'cart')
        ->get();
        if ($itemcart) {
            $data = array('title' => 'Shopping Cart', 'itemcart' => $itemcart, 'cart' => $cart, 'total' => $total,);
            return view('user.cart.checkout', compact('channels', 'id'), $data)->with('no', 1);
        } else {
            return abort('404');
        }
    }

    public function detailPembayaran($reference)
    {
        $apiKey = config('tripay.api_key');

        $payload = ['reference'	=> $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $detail = json_decode($response)->data;

        return view('user.cart.pembayaran', compact('detail'));
    }
}
