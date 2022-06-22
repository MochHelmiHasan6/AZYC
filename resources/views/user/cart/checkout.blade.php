@extends('user.layout.app')
@section('header')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-8">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-warning">
                <p>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="row mb-2">
                <div class="col col-12 mb-2">
                    <div class="card">
                        <div class="card-header">
                            Item
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jasa</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemcart as $detail)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $detail->name }}
                                        </td>
                                        <td>
                                            {{ number_format($detail->harga, 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($detail->qty, 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($detail->total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col col-12 mb-2">
                    <div class="card">
                        <div class="card-header">Form Data</div>
                        <div class="card-body">
                            <div class="col-md-12 mb-4">
                                <label for="nama_penerima">Nama Lengkap *</label>
                                <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" value="" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="no_hp">No HP *</label>
                                <input type="number" name="no_hp" class="form-control" id="phone_number" min="0"
                                value="" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="alamat">Alamat *</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 mb-2">
                    <div class="card">
                        <div class="card-header">Metode Pembayaran</div>
                        <div class="card-body">
                            <div class="row mb-2">
                                @foreach ($channels as $channel)
                                @if ($channel->active)
                                <div class="col-sm-4 mb-4">
                                    <form action="{{route('transaksi.store')}}">
                                        @csrf
                                        {{-- <button type="submit"> --}}
                                            <div class="bg-white bg-gradient rounded shadow-soft border border-primary d-flex justify-content-center">
                                                <div>
                                                    <img src="" alt="">
                                                    <p class="mt-3 text-xs text-grey-600">{{$channel->name}}</p>
                                                </div>
                                            </div>
                                        {{-- </button> --}}
                                    </form>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-4">
            <div class="card">
                <div class="card-header">
                    Ringkasan
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>No Invoice</td>
                            <td class="text-right">
                                {{ $cart->no_invoice }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="text-right">
                                {{ number_format($total, 2) }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <form action="{{ route('transaksi.store') }}" method="post">
                        @csrf()
                        <button type="submit" class="btn btn-danger btn-block">Buat Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection
