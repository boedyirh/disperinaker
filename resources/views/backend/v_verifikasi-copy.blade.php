
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

    .marginsamping{
        padding-left: 15px !important;
        padding-right: 15px !important;
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
      background-color: burlywood;
    }

</style>
@endpush

@push('scripts')

@endpush

@section('content')
<div>
    <div class="row marginsamping">
        @livewire('show-biodata',['rand_ak1'=>$rand_ak1])
        {{-- <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"> Biodata</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <img class="profile-user-img img-responsive" src="{{ url('storage/foto_diri/'.$data_pemohon->foto_diri) }}" width="300" height="200" alt="Foto diri">
                  <h3 class="profile-username text-center">{{ $data_pemohon->nama }}</h3>
                  <p class="text-muted text-center"> Phone :  {{ substr($data_pemohon->nomer_hp, 0, 4) . "-" . substr($data_pemohon->nomer_hp, 4, 4) . "-" . substr($data_pemohon->nomer_hp, 8,7) }}
                  </p>
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Jenis Kelamin</td>
                        <td>{{ $data_pemohon->nama_jeniskelamin }}</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Status Kawin</td>
                        <td>{{ $data_pemohon->nama_kawin }}</td>
                      </tr>
                      <tr>
                          <td>3.</td>
                          <td>Tempat Lahir</td>
                          <td>{{ $data_pemohon->tempat_lahir }}</td>
                        </tr>
                        <tr>
                          <td>4.</td>
                          <td>Tgl Lahir</td>
                          <td>{{ date("d-m-Y",strtotime($data_pemohon->tgl_lahir))}}</td>
                        </tr>
                      <tr>
                        <td>5.</td>
                        <td>Agama</td>
                        <td>{{ $data_pemohon->nama_agama }}</td>
                      </tr>
                      <tr class="warna">
                        <td> </td>
                        <td>Jadwal Ambil</td>
                        <td>{{ date("d-m-Y",strtotime($data_pemohon->tanggal_jadwal))}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="text-center" >
                    <a href="#" class="btn btn-primary button-rapi"><b>Cetak Kartu</b></a>
                  </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div> --}}
        {{-- <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Alamat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Alamat</td>
                        <td>
                          {{ $data_pemohon->alamat }}
                        </td>

                      </tr>
                    <tr>
                      <td>2.</td>
                      <td>Kecamatan</td>
                      <td>
                        {{ $data_pemohon->nama_kecamatan }}
                      </td>

                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Kelurahan/Desa</td>
                        <td>
                          {{ $data_pemohon->nama_keldesa }}
                        </td>

                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Kelurahan/Desa</td>
                        <td>
                          {{ $data_pemohon->nama_keldesa }}
                        </td>

                      </tr>

                  </tbody></table>
                  <div class="text-center " >
                    <a href="#" class="btn btn-primary button-rapi"><b>Lihat KTP</b></a>
                  </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Status Pengajuan</h3>
                </div>
                <div class="box-body marginbody">
                    <div class="marginselect">
                        <select name="" id="">
                            <option value="1">Pengajuan</option>
                            <option value="2">Revisi</option>
                            <option value="3">Tidak diambil</option>
                            <option value="4">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <textarea name="" id="" cols="40" rows="3"></textarea>
                    </div>
                 </div>
                 <div class="box-footer">
                    <a href="/admin/daftar" class="btn   btn-warning">Batal</a>
                     <button class="btn btn-primary">Simpan</button>
                 </div>
            </div>
        </div> --}}
        <div class="col-md-5">
            <div class="row marginsamping">
                <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">Pendidikan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th class="text-center">Institusi/Sekolah</th>
                            <th class="text-center">Strata</th>
                            <th class="text-center">Tahun</th>
                            <th style="width: 40px">Berkas</th>
                        </tr>

                        @if($data_pendidikan == NULL)
                          <tr>
                            <td colspan="6" class="text-center">Tidak ada data Pendidikan</td>
                          </tr>
                        @else
                            <?php $no=1?>
                            @foreach ($data_pendidikan as $dataItem)
                              <tr>
                                  <td class="text-center">{{ $no++ }}</td>
                                  <td> {{ $dataItem->nama_tingkatpendidikan}}</td>
                                  <td> {{ $dataItem->nama_institusi}}</td>
                                  <td class="text-center"> {{ $dataItem->tahun_lulus}}</td>
                                  <td class="text-center"> {{ $dataItem->file_asli}}</td>
                              </tr>
                          @endforeach
                        @endif



                      </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="row marginsamping">
                <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">Pelatihan/Skill</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-striped">
                        <tbody><tr>
                          <th style="width: 10px">#</th>
                          <th class="text-center">Keahlian</th>
                          <th class="text-center">Lembaga Pelatihan</th>
                          <th class="text-center">Tahun</th>
                          <th style="width: 40px">Berkas</th>
                        </tr>
                        @if($data_pelatihan == NULL)
                          <tr>
                            <td colspan="5" class="text-center">Tidak ada data Pelatihan</td>
                          </tr>
                        @else
                            <?php $no=1?>
                            @foreach ($data_pelatihan as $dataItem)
                              <tr>
                                  <td class="text-center">{{ $no++ }}</td>
                                  <td> {{ $dataItem->nama_jenispelatihan}}</td>
                                  <td> {{ $dataItem->lembaga_pelatihan}}</td>
                                  <td class="text-center"> {{ $dataItem->tahun}}</td>
                                  <td class="text-center"> {{ $dataItem->file_asli}}</td>
                              </tr>
                          @endforeach
                        @endif


                      </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="row marginsamping">
                <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">Pengalaman Kerja</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-striped">
                        <tbody><tr>
                          <th style="width: 10px">#</th>
                          <th class="text-center">Perusahaan/Lembaga</th>
                          <th class="text-center">Jabatan</th>
                          <th class="text-center">Tahun</th>
                          <th style="width: 40px">Berkas</th>
                        </tr>

                        @if($data_pelatihan == NULL)
                        <tr>
                          <td colspan="5" class="text-center">Tidak ada data Pengalaman Kerja</td>
                        </tr>
                      @else
                          <?php $no=1?>
                          @foreach ($data_pekerjaan as $dataItem)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td> {{ $dataItem->nama_perusahaan}}</td>
                                <td> {{ $dataItem->jabatan}}</td>
                                <td class="text-center"> {{ $dataItem->tahun}}</td>
                                <td class="text-center"> {{ $dataItem->file_asli}}</td>
                            </tr>
                        @endforeach
                      @endif


                      </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
