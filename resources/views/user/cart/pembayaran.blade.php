@extends('user.layout.app')
@section('header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-8">
            <div class="col col-12 mb-2">
                <div class="card">
                    <div class="card-header">Detail Pembayaran</div>
                    <div class="card-body">
                        <div class="row">
                            <p>Kode Pembayaran: #{{$detail->reference}}</p>
                            <p>Total Bayar: Rp. {{number_format($detail->amount)}}</p>
                            <p>Status Pembayaran: {{$detail->status}}</p>
                            <h5>Instruksi Pembayaran</h5>
                            @foreach ($detail->instructions as $instruction)
                            <button type="button" class="btn btn-primary mb-4" data-toggle="collapse" data-target="#demo">{{$instruction->title}}</button>
                            <div id="demo" class="collapse mb-4">
                                @if ($detail->payment_method == 'QRISD' || 'QRIS')
                                    <img src={{$detail->qr_url}} alt="">
                                @endif
                                @if ($detail->payment_method == 'OVO')
                                    <button class="btn btn-light"><a href={{$detail->pay_url}}>Lanjutkan Pembayaran</a></button>
                                @endif
                                @foreach ($instruction->steps as $step)
                                <li>{!! $step !!}</li>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection
