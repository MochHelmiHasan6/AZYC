@extends('admin.layouts.app')
@section('header')
<style>
    .ik {
        cursor: pointer;
    }

    #trHover:hover {
        background-color: #e6e6e6;
    }

</style>
@endsection
@section('iconHeader')
<i class="mdi mdi-sitemap bg-inverse"></i>
@endsection
@section('titleHeader')
Data Pesanan
@endsection
@section('subtitleHeader')
Data Pesanan
@endsection
@section('breadcrumb')
Data Pesanan
@endsection
@section('content-wrapper')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        {{-- report --}}
                        <form action="{{ route('transaksi.report') }}" method="GET">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 mb-1">
                                        <label for="date">From</label>
                                        <div class="input-group input-group-sm mb-3">
                                            <input required type="date" name="from_date" id="from_date" class="form-control" placeholder="Choose a date" id="password-id-icon" value="{{ request('from_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <label for="date">To</label>
                                        <div class="input-group input-group-sm mb-3">
                                            <input required type="date" name="to_date" id="to_date" class="form-control" placeholder="Choose a date" id="password-id-icon" value="{{ request('to_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <div class="input-group input-group-sm mb-3 mt-4">
                                            <button type="submit" class="btn btn-success">Print</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                        {{--  --}}

                        <div class="dt-responsive">
                            <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 102%">
                                <thead>
                                    <tr>
                                        <th style="width: 3%"></th>
                                        <th>User</th>
                                        <th>Reference</th>
                                        <th>Merchant Reference</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <th>User</th>
                                        <th>Reference</th>
                                        <th>Merchant Reference</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('transaksi.destroy', 'id') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <input id="id" name="id" type="hidden">
                            You want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('footer')
<script src="{{ url('assets/admin/dynamictable/dynamitable.jquery.min.js') }}"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
            '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
    $(document).on('click', '.delete', function () {
        let id = $(this).attr('data-id');
        $('#id').val(id);
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#dataTable tfoot th').each(function () {
            var title = $('#dataTable thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
        });

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "initComplete": function (settings, json) {
                $("#dataTable").wrap(
                    "<div class='scroll' style='overflow:auto; width:100%;position:relative;padding-left:20px;padding-bottom:20px'></div>"
                    );
            },
            ajax: "{{ route('transaksi.index') }}",
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'user_name',
                    name: 'users.name'
                },
                {
                    data: 'reference',
                    name: 'reference'
                },
                {
                    data: 'merchant_ref',
                    name: 'merchant_ref'
                },
                {
                    data: 'paid_total',
                    name: 'paid_total'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
            ]
        });
        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });

</script>
@endsection

@section('fixedButton')
<a class="fixedButtonRefresh" href>
    <button data-toggle="tooltip" data-placement="top" title="" type="button" class="btn btn-icon btn-secondary "
        onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<a class="fixedButtonAdd" href="{{route('transaksi.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info"
        data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
@endsection
