@extends('layouts.v_template_fe')

@push('styles')
<style>

    .penuh
    {

        width: 100%;
    }

    .scroll {

        overflow: auto;
    }
    .align-middle {
        vertical-align: middle !important;
    }
    .sticky tr:nth-child(2) th{
        background: white;
        position: sticky;
        top: 0px;
        z-index: 10;
    }
    .abu {
        background: #dde2e7 !important;
    }
    .hijau {
        background: #50cb93 !important;
    }
    .birulte {
        background: #337ab7 !important;
        color:#dde2e7 !important;
    }

    .btn-success1 {
        background: rgb(64, 173, 113); !important;
        color:#dde2e7 !important;
    }
  .table-responsive{
    height:400px;
    overflow:scroll;
    }

.weekBerikutnya:hover {
    cursor: pointer;
}
.weekSebelumnya:hover {
    cursor: pointer;
}



</style>
@endpush

@push('scripts')
<script>




  </script>


@endpush

@section('content')
    <!-- MultiStep Form -->
        @if (Session::has('currentStep'))
            @php
                $passData = Session::get('currentStep');
                $currentStep = $passData['currentStep'];
                $rand_ak1    = $passData['rand_ak1'];
                $sudah_pilih_jadwal    = $passData['sudah_pilih_jadwal'];
                if($rand_ak1=='0' && $currentStep==1 ){
                   //Start Awal
                } elseif ($rand_ak1 !='0' && $currentStep==1 ){
                    $data = $passData['data_diri'];
                   //Edit Data
                }

            @endphp
        @endif
        <div class="row">
            <div class="col-md-12">
                <div id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="{{ $currentStep > 0 ? 'active' : '' }}">Data Diri</li>
                            <li class="{{ $currentStep > 1 ? 'active' : '' }}">Jadwal Wawancara</li>
                            <li class="{{ $currentStep > 2 ? 'active' : '' }}">Data Pendidikan</li>
                            <li class="{{ $currentStep > 3 ? 'active' : '' }}">Data Pelatihan</li>
                            <li class="{{ $currentStep > 4 ? 'active' : '' }}">Data Pengalaman Kerja</li>
                            <li class="{{ $currentStep > 5 ? 'active' : '' }}">Upload Foto</li>
                            <li class="{{ $currentStep > 6 ? 'active' : '' }}">Lihat Preview</li>
                        </ul>

                        <!-- fieldsets Step1 Data Diri-->
                            @if ($currentStep==1)
                            <form  method="POST" >
                                @csrf
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <input type="hidden" name="currentStep"  value="1"/>
                                    <h2 class="fs-title">Data Diri</h2>
                                    <h3 class="fs-subtitle">Isi data diri anda </h3>
                                    @if ($rand_ak1=='0' && $currentStep==1)
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row @error('nama') has-error @enderror">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"   name="nama" placeholder="Nama lengkap sesuai KTP" >
                                                        @error('nama')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('nik') has-error @enderror">
                                                    <label for="inputEmail" class="col-sm-3 col-form-label">Nomer KTP/NIK</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nik"   placeholder="Nomer KTP" >
                                                        @error('nik')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('tempat_lahir') has-error @enderror">
                                                    <label for="inputName2" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"  name="tempat_lahir" placeholder="Tempat Lahir sesuai KTP">
                                                        @error('tempat_lahir')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('tgl_lahir') has-error @enderror">
                                                    <label  class="col-sm-3">Tanggal Lahir</label>
                                                    <div class="col-sm-9">
                                                            <input type="date" class="form-control" name="tgl_lahir" placeholder="Format 27-12-2001" >
                                                            @error('tgl_lahir')
                                                                <span class="help-block"> {{ $message }}</span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group" id="gender_field">
                                                    <label  class="col-sm-3">Jenis Kelamin</label>
                                                    <div class="input-group">
                                                        <label class="radio-inline" for="laki-laki">
                                                            <input type="radio" id="laki-laki" name="jeniskelamin_id" value="1" required="true">
                                                            <span>Laki-laki</span>
                                                        </label>
                                                        <label class="radio-inline" for="perempuan">
                                                            <input type="radio" id="perempuan" name="jeniskelamin_id" value="2" required="true">
                                                            <span>Perempuan</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('tinggi') has-error @enderror">
                                                    <label class="col-sm-3 ">Tinggi Badan</label>
                                                    <div class="input-group col-sm-3">
                                                        <input type="text" class="form-control" name="tinggi" >
                                                        <span class="input-group-addon text-center">cm</span>
                                                    </div>
                                                    @error('tinggi')
                                                        <span class="help-block"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row @error('berat') has-error @enderror">
                                                    <label class="col-sm-3 ">Berat Badan</label>
                                                    <div class="input-group col-sm-3">
                                                        <input type="text" class="form-control" name="berat" >
                                                        <span class="input-group-addon text-center">&nbsp;kg</span>
                                                    </div>
                                                    @error('berat')
                                                        <span class="help-block"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row @error('agama_id') has-error @enderror">
                                                    <label class="col-sm-3">Agama</label>
                                                    <div class="col-sm-4 kiri">
                                                        <select class="form-control" name="agama_id" >
                                                            <option value="">-- Pilih --</option>
                                                            <option value="1">Islam</option>
                                                            <option value="2">Kristen Protestan</option>
                                                            <option value="3">Katolik</option>
                                                            <option value="4">Hindu</option>
                                                            <option value="5">Budha</option>
                                                            <option value="6">Konghucu</option>
                                                        </select>
                                                        @error('agama_id')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">



                                                @livewire('dropdown-keldesa-lw')

                                                <div class="form-group row @error('alamat') has-error @enderror">
                                                    <label for="inputName2" class="col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="alamat" placeholder="Alamat domisili" >
                                                        @error('alamat')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-3 col-form-label">Nomer HP</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nomer_hp" placeholder="Nomer HP Aktif" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="email" placeholder="Email aktif" >
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @elseif ($rand_ak1!='0' && $currentStep==1)
                                        @foreach ($data as $item)
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"   name="nama" value="{{ $item->nama}} " >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer KTP/NIK</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nik"   value="{{ $item->nik}} " >

                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label for="inputName2" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"  name="tempat_lahir" value="{{ $item->tempat_lahir}} ">

                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label  class="col-sm-3">Tanggal Lahir</label>
                                                        <div class="col-sm-9">
                                                                <input type="date" class="form-control" name="tgl_lahir" value="{{ $item->tgl_lahir}}" >

                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="gender_field">
                                                        <label  class="col-sm-3">Jenis Kelamin</label>
                                                        <div class="input-group">
                                                            <label class="radio-inline" for="laki-laki">
                                                                <input type="radio" id="laki-laki" name="jeniskelamin_id" value="1" required="true" {{$item->jeniskelamin_id == '1'? 'checked' : ''}}>
                                                                <span>Laki-laki</span>
                                                            </label>
                                                            <label class="radio-inline" for="perempuan">
                                                                <input type="radio" id="perempuan" name="jeniskelamin_id" value="2" required="true" {{$item->jeniskelamin_id == '2'? 'checked' : ''}}>
                                                                <span>Perempuan</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label class="col-sm-3 ">Tinggi Badan</label>
                                                        <div class="input-group col-sm-3">
                                                            <input type="text" class="form-control" name="tinggi" value="{{ $item->tinggi}} " >
                                                            <span class="input-group-addon text-center">cm</span>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row ">
                                                        <label class="col-sm-3 ">Berat Badan</label>
                                                        <div class="input-group col-sm-3">
                                                            <input type="text" class="form-control" name="berat" value="{{ $item->berat}} ">
                                                            <span class="input-group-addon text-center">&nbsp;kg</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label class="col-sm-3">Agama</label>
                                                        <div class="col-sm-4 kiri">
                                                            <select class="form-control" name="agama_id" >
                                                                <option value="">-Pilih Agama-</option>
                                                                @foreach($d_agama as $agamaitem)
                                                                    <option value="{{ $agamaitem['value_dropdown']}}" {{ $item->agama_id == $agamaitem['value_dropdown'] ? 'selected="selected"' : '' }}>{{ $agamaitem['label_dropdown'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                        @php
                                                        $alamat_lw = [
                                                            'selectedKecamatan'=>$item->kecamatan_id,
                                                            'keldesa_id'=>$item->keldesa_id,

                                                            ];
                                                        @endphp
                                                    @livewire('dropdown-keldesa-lw',$alamat_lw)


                                                    <div class="form-group row ">
                                                        <label for="inputName2" class="col-sm-3 col-form-label">Alamat</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="alamat"  value="{{ $item->alamat}} " >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputExperience" class="col-sm-3 col-form-label">Nomer HP</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nomer_hp" value="{{ $item->nomer_hp}} " >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputSkills" class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="email" value="{{ $item->email}} " >
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                    <input type="submit" name="next1" class="next1 action-button" value="Berikutnya"/>
                                    </form>
                                </fieldset>
                            @else
                                <fieldset style=" position: absolute; opacity: 0; display: none;">
                                </fieldset>
                            @endif
                        <!-- akhir fieldsets Step1 Data Diri -->

                        <!-- fieldsets Step2 Jadwal Wawancara-->
                                @if ($currentStep==2)
                                    <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">


                                        @if(!$sudah_pilih_jadwal)
                                            <h2 class="fs-title">Jadwal Wawancara dan Pengambilan Kartu</h2>

                                            @livewire('data-wawancara-lw',['rand_ak1'=>$rand_ak1])
                                        @else
                                            <h2 class="fs-title">Jadwal Wawancara dan Pengambilan Kartu</h2>
                                            <h3 class="fs-subtitle">Anda Sudah menjadwalkan wawancara dan pengambilan kartu</h3>
                                            @livewire('show-jadwal-lw',['rand_ak1'=>$rand_ak1])
                                        @endif
                                        <hr>
                                        <form  method="POST" >
                                            @csrf
                                            <input type="hidden" name="currentStep"  value="2"/>
                                            <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                            <input type="submit" name="action" class="previous1 action-button-previous" value="Sebelumnya"/>
                                            <input type="submit" name="action" class="next1 action-button" value="Berikutnya"/>
                                        </form>
                                    </fieldset>
                                @else
                                    <fieldset style=" position: absolute; opacity: 0; display: none;">
                                    </fieldset>
                                @endif

                        <!-- akhir fieldsets Step2 Jadwal Wawancara -->


                        <!-- fieldsets Step3 Data Pendidikan-->
                            @if ($currentStep==3)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Data Pendidikan</h2>
                                    <h3 class="fs-subtitle">Masukkan 1 data saja jika hanya menginputkan Pendidikan Terakhir. Jika terjadi kesalahan, Hapus dan tambahkan data yg benar</h3>
                                        @livewire('data-pendidikan-lw',['rand_ak1'=>$rand_ak1])
                                    <hr>
                                    <form  method="POST" >
                                        @csrf
                                        <input type="hidden" name="currentStep"  value="3"/>
                                        <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                        <input type="submit" name="action" class="previous1 action-button-previous" value="Sebelumnya"/>
                                        <input type="submit" name="action" class="next1 action-button" value="Berikutnya"/>
                                    </form>
                                </fieldset>
                            @else
                                <fieldset style=" position: absolute; opacity: 0; display: none;">
                                </fieldset>
                            @endif

                        <!-- akhir fieldsets Step3 Data Pendidikan -->

                        <!-- fieldsets Step4 Data Pelatihan-->
                            @if ($currentStep==4)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Data Pelatihan</h2>
                                    <h3 class="fs-subtitle">Masukkan data pelatihan yang pernah diikuti.</h3>
                                        @livewire('data-pelatihan-lw',['rand_ak1'=>$rand_ak1])
                                    <hr>
                                    <form  method="POST" >
                                        @csrf
                                        <input type="hidden" name="currentStep"  value="4"/>
                                        <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                        <input type="submit" name="action" class="previous1 action-button-previous" value="Sebelumnya"/>
                                        <input type="submit" name="action" class="next1 action-button" value="Berikutnya"/>
                                    </form>
                                </fieldset>
                            @else
                                <fieldset style=" position: absolute; opacity: 0; display: none;">
                                </fieldset>
                            @endif
                        <!-- akhir fieldsets Step4 Data Pelatihan -->

                        <!-- fieldsets Step5 Data Pengalaman Kerja-->
                            @if ($currentStep==5)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Data Pengalaman Kerja</h2>
                                    <h3 class="fs-subtitle">Hanya diisi jika pernah bekerja.</h3>
                                    @livewire('data-pengalamankerja-lw',['rand_ak1'=>$rand_ak1])
                                    <hr>
                                    <form  method="POST" >
                                        @csrf
                                        <input type="hidden" name="currentStep"  value="5"/>
                                        <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                        <input type="submit" name="action" class="previous1 action-button-previous" value="Sebelumnya"/>
                                        <input type="submit" name="action" class="next1 action-button" value="Berikutnya"/>
                                    </form>
                                </fieldset>
                            @else
                                <fieldset style=" position: absolute; opacity: 0; display: none;">
                                </fieldset>
                            @endif

                        <!-- akhir fieldsets Step5 Data Pengalaman Kerja -->

                        <!-- fieldsets Step6 Upload Foto-->
                            @if ($currentStep==6)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Upload Foto KTP dan Passfoto 3x4</h2>
                                    <h3 class="fs-subtitle">Ukuran maksimal foto 1 mega.</h3>
                                    @livewire('data-foto-lw',['rand_ak1'=>$rand_ak1])
                                    <hr>
                                    <form  method="POST" >
                                        @csrf
                                        <input type="hidden" name="currentStep"  value="6"/>
                                        <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                        <input type="submit" name="action" class="previous1 action-button-previous" value="Sebelumnya"/>
                                        <input type="submit" name="action" class="next1 action-button" value="Berikutnya"/>
                                    </form>
                                </fieldset>
                            @else
                                <fieldset style=" position: absolute; opacity: 0; display: none;">
                                </fieldset>
                            @endif


                        <!-- akhir fieldsets Step6 Upload Foto -->

                        <!-- fieldsets Step7 Preview dan Simpan-->
                            @if ($currentStep==7)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Preview Semua Data</h2>
                                    <h3 class="fs-subtitle">Mengecek data sebelum diajukan</h3>
                                    @livewire('data-preview-lw',['rand_ak1'=>$rand_ak1])
                                    <hr>
                                    <form  method="POST" >
                                        @csrf
                                        <input type="hidden" name="currentStep"  value="7"/>
                                        <input type="hidden" name="rand_ak1"  value="{{ $rand_ak1 }}"/>
                                        <input type="submit" name="action" class="previous1 action-button-previous" value="Sebelumnya"/>
                                        <input type="submit" name="action" class="submit1 action-button" value="Ajukan"/>
                                    </form>
                                </fieldset>
                            @else
                                <fieldset style=" position: absolute; opacity: 0; display: none;">
                                </fieldset>
                            @endif

                        <!-- akhir fieldsets Step7 Preview dan Simpan -->


                    </div>
            </div>
        </div>
    <!-- /.MultiStep Form -->

@endsection
