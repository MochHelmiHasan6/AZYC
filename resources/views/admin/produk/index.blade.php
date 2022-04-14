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
Data Produk
@endsection
@section('subtitleHeader')
Data Produk
@endsection
@section('breadcrumb')
Data Produk
@endsection
@section('content-wrapper')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 102%">
                                <thead>
                                    <tr>
                                        <th style="width: 3%"></th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
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
                    <form action="{{ route('produk.destroy', 'id') }}" method="POST">
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
            ajax: "{{ route('produk.index') }}",
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
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
<a class="fixedButtonAdd" href="{{route('produk.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info"
        data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
@endsection
