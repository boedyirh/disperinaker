@extends('layouts.v_template')
@section('title','Dashboard Kartu Pencari Kerja - v_ak1.blade.php')
@push('styles')
    <!-- Styles dari Blade Template-->
    <link href="{{ asset('css/pizza.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Scripts dari Blade Template -->
    <!-- ChartJS -->
    <script src="{{asset('template')}}/bower_components/chart.js/Chart.js"></script>
    <script src="{{asset('js')}}/chart_kartukerja.js"></script>
@endpush


@section('content')
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                        <h3>150</h3>
                        <p>Pendaftar Bulan ini</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-person-add"></i>
                        </div>
                        <a href="/ak1/pendaftaran" class="small-box-footer">Pendaftaran AK-1 <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p> Pendaftar Bulan lalu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/ak1/wawancara" class="small-box-footer">Kelola Wawancara <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                        <h3>444</h3>
                        <p>Pendaftar Tahun ini</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>65</h3>
                        <p>Data Kotor</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-wrench"></i>
                        </div>
                        <a href="#" class="small-box-footer">Hapus data kotor <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Rekapitulasi Bulanan Pengajuan Kartu Pencari Kerja</h3>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                <canvas id="barChart" style="height: 229px; width: 524px;" width="1084" height="473"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
