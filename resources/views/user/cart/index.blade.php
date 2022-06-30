@extends('user.layout.app')
@section('header')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-8">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($countcart > 0)
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
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
                                            @method('patch')
                                            @csrf()
                                            <input type="hidden" name="param" value="kurang">
                                            <button class="btn btn-primary btn-sm">
                                                -
                                            </button>
                                        </form>
                                        <button class="btn btn-outline-primary btn-sm" disabled="true">
                                            {{ number_format($detail->qty, 2) }}
                                        </button>
                                        <form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
                                            @method('patch')
                                            @csrf()
                                            <input type="hidden" name="param" value="tambah">
                                            <button class="btn btn-primary btn-sm">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    {{ number_format($detail->total, 2) }}
                                </td>
                                <td>
                                    <form action="{{ route('cartdetail.destroy', $detail->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-sm btn-danger mb-2">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card">
                <div class="card-header">
                    Ringkasan
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>No Invoice</td>
                            <td class="text-right">
                                @if ($countcart > 0)
                                {{ $cart->no_invoice }}
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="text-right">
                                @if ($countcart > 0)
                                {{ number_format($total, 2) }}
                                @else
                                -
                                @endif
                                {{-- <input type="hidden" name="paid_total" value="{{$total}}"> --}}
                            </td>
                        </tr>
                    </table>
                </div>
                @if ($countcart > 0)
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a href="{{ url('checkout').'/'.$cart->id }}" class="btn btn-primary btn-block">
                                Checkout
                            </a>
                        </div>
                        <div class="col">
                            <form action="{{ url('kosongkan').'/'.$cart->id }}" method="post">
                                @csrf()
                                <button type="submit" class="btn btn-danger btn-block">Kosongkan</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection
