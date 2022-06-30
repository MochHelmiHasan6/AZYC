@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="{{url('assets/admin/plugins/select2/dist/css/select2.min.css')}}">
@endsection
@section('titleHeader')
Pesanan
@endsection
@section('subtitleHeader')
Edit Pesanan
@endsection
@section('breadcrumb')
Pesanan
@endsection
@section('content-wrapper')
<input class="js-dynamic-enable" type="hidden"/>
<input class="js-dynamic-disable" type="hidden"/>

<input type="hidden" class="js-large" />
<input type="hidden" class="js-medium" />
<input type="hidden" class="js-small" />
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form class="text-left border border-light p-5" action="{{route('transaksi.update',$data->id)}}" method="POST"
                    enctype="multipart/form-data" style="padding-bottom: 50px;">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>User</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                                <select name="user_id" class="select2 form-control" id="default-select">
                                        @foreach($users as $u)
                                        <option value="{{$u->id}}"
                                            {{$data->user_id == $u->id ? 'selected' : ''}}
                                        >{{$u->name}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Reference</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control" placeholder="Reference" value="{{$data->reference}}" disabled>

                        <input type="hidden" name="reference" class="reference" value="{{$data->reference}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Merchant Reference</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control" placeholder="Merchant Reference" value="{{$data->merchant_ref}}" disabled>

                        <input type="hidden" name="merchant_ref" class="merchant_ref" value="{{$data->merchant_ref}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Bayar</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control" placeholder="Total Bayar" value="{{$data->paid_total}}" disabled>

                        <input type="hidden" name="paid_total" class="paid_total" value="{{$data->paid_total}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <select name="status" class="select2 form-control" id="default-select">
                                <option value="UNPAID" {{$data->status == "UNPAID" ? 'selected' : ''}}>UNPAID</option>
                                <option value="PAID" {{$data->status == "PAID" ? 'selected' : ''}}>PAID</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control" placeholder="Alamat" name="address" value="{{$data->address}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>No Hp</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="No HP" name="no_hp" value="{{$data->no_hp}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="footer-buttons">
                        <a class="fixedButtonRefresh" href="{{route('transaksi.index')}}">
                            <button data-toggle="tooltip" data-placement="top" title="" type="button"
                                class="btn btn-icon btn-secondary " data-original-title="Back">
                                <i class="ik ik-arrow-left"></i>
                            </button>
                        </a>
                        <a class="fixedButtonAdd">
                            <button data-toggle="tooltip" type="submit" data-placement="top" title="" href=""
                                class="btn btn-icon btn-info" data-original-title="Tambah">
                                <i class="ik ik-save"></i>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@endsection
@section('fixedButton')

@endsection
@section('footer')

<script src="{{url('assets/admin/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/jquery.repeater/jquery.repeater.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/mohithg-switchery/dist/switchery.min.js')}}"></script>
<script src="{{url('assets/admin/js/form-advanced.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    var SITEURL = "{{URL('/')}}";
    $(function () {
        uploadSuccess = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Success',
                text: 'Transaksi berhasil diperbarui',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
            })

        };
        $(document).ready(function () {
            $('#fileUploadForm').ajaxForm({
                beforeSend: function () {
                    var percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%',
                        function () {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        });
                },
                complete: function (xhr) {
                    var percentage = '0';
                    uploadSuccess();
                    setTimeout(function () {
                        window.location.href = SITEURL + "/" + "admin-page/transaksi";
                    }, 3000);
                }
            });

        });
    });

</script>
@endsection
