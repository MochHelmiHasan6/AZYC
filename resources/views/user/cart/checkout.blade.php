@extends('user.layout.app')
@section('header')
<style>
    .channel-active{
        background-color:#f1eefc;
        border-radius:10px;
    }
    .payment-channel:hover{
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="container">

    <form action="{{ route('cart.store') }}" method="post">
        <input type="hidden" name="cart_id" value="{{$id}}">
        @csrf
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
                                    <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"
                                        value="" required>
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
                    <div class="col col-12 mb-1">
                        <div class="card">
                            <div class="card-header">Metode Pembayaran</div>
                            <div class="card-body">
                                <div class="row">
                                    <select name="channel" id="channel" hidden>
                                        @foreach ($channels as $channel)
                                        @if ($channel->active)
                                        <div class="col-md-4">
                                            {{-- <button type="submit"> --}}
                                            <option value="{{$channel->code}}">
                                        </div>
                                        @endif
                                        @endforeach
                                    </select>
                                    @foreach ($channels as $channel)
                                    @if ($channel->active)
                                    <div  class="col-md-4 payment-channel p-2" style="align-self: center;">
                                        <div id="{{$channel->code}}"
                                            onclick="selectChannel('{{$channel->code}}')" style="text-align: center;">
                                            <div>
                                                <img class="mt-2" src="{{$channel->icon_url}}" alt="" width="50%">
                                                <p class="mt-2 text-xs text-grey-600">{{$channel->name}}</p>
                                            </div>
                                        </div>
                                        {{-- </button> --}}

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
                                <input type="hidden" name="total" value="{{$total}}">
                                <td class="text-right">
                                    {{ number_format($total, 2) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger btn-block">Buat Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer')
<script>
    let temp = ''
    function selectChannel(code) {
        $('#channel option[value='+code+']').attr('selected','selected')

        if($('#'+temp).hasClass('channel-active')){
            $('#'+temp).removeClass('channel-active')
        }else{
            $('#'+temp).addClass('channel-active')
        }
        temp = code
        if($('#'+code).hasClass('channel-active')){
            $('#'+code).removeClass('channel-active')
        }else{
            $('#'+code).addClass('channel-active')
        }

    }

</script>
@endsection
