
@extends('layouts.v_template')
@section('title','Halaman Verifikasi v_verifikasi.blade.php')
{{-- @section('breadcrumb','Setting Aplikasi') --}}

@push('styles')
<style>
    .col-md-12{
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    .col-md-5{
        padding-left: 15px !important;
        padding-right: 5px !important;
    }
    .col-md-7{
        padding-left: 5px !important;
        padding-right: 0px !important;
    }

    .marginsampingx{

        padding-right: 25px !important;
    }
    .small-padding{
        padding-left: 0px !important;
        }
    .marginselect{
        padding-top: 0px !important;
        padding-bottom: 15px !important;
    }
    .margin-all{
        padding: 15px !important;

    }
    .marginbody{
        padding-top: 0px !important;
    }
    .button-rapi {
      margin : 12px !important;
    }
    .warna {
      background-color: burlywood !important;
    }
    .modal-dialog {
        position: absolute;
        top: 40px;
        right: 100px;
        bottom: 0;
        left: 920px;
        z-index: 10040;
        overflow: auto;
        overflow-y: auto;
        }

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script>
    new Pikaday({
        field: document.getElementById('tgl_lahir'),
        format: 'YYYY-MM-DD',
        yearRange: [1970, 2009],
    })
</script>
@endpush

@section('content')
<div>
    <div class="row marginsampingx">
        @livewire('backend.show-biodata',['rand_ak1'=>$rand_ak1])
        <div class="col-md-4 small-padding">
            @livewire('backend.show-alamat',['rand_ak1'=>$rand_ak1])
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Lihat KTP</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding"  style="display: none;">
                    <img   src="{{ url('storage/foto_ktp/'.$data_pemohon->foto_ktp) }}" width="360" height="240" alt="Foto diri">

                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="">
                  <a href="javascript:void(0)" class="uppercase">{{ $data_pemohon->nama }}</a>
                </div>
                <!-- /.box-footer -->
              </div>

            @livewire('backend.pejabat',['rand_ak1'=>$rand_ak1])
        </div>
        <div class="col-md-5">
            @livewire('backend.show-pendidikan',['rand_ak1'=>$rand_ak1])
            @livewire('backend.show-pelatihan',['rand_ak1'=>$rand_ak1])
            @livewire('backend.show-pengalaman-kerja',['rand_ak1'=>$rand_ak1])
        </div>
    </div>
</div>


@endsection
