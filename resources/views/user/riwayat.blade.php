@extends('user.layout.app')
@section('header')
@endsection
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col col-12 mb-2">
            <div class="card">
                <div class="card-header">
                    Riwayat Transaksi
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Reference</th>
                                <th>Merchant Reference</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>
                                    {{ $d->user_name}}
                                </td>
                                <td>
                                    {{ $d->reference }}
                                </td>
                                <td>
                                    {{ $d->merchant_ref }}
                                </td>
                                <td>
                                    {{ number_format($d->paid_total, 2) }}
                                </td>
                                <td>
                                    {{ $d->status }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection
