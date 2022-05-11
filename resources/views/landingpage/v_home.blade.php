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

        .orange {
            background: #f39c12 !important;

        }

        .btn-success1 {
            background: rgb(64, 173, 113); !important;
            color:#dde2e7 !important;
        }
    .table-responsive{
        height:400px;
        overflow:scroll;
        }
        .mr-1 {
            margin-right: 0.25rem !important;
        }

        .weekBerikutnya:hover {
            cursor: pointer;
        }
        .weekSebelumnya:hover {
            cursor: pointer;
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
                            <li class="{{ $currentStep > 1 ? 'active' : '' }}">Data Pendidikan</li>
                            <li class="{{ $currentStep > 2 ? 'active' : '' }}">Data Pelatihan</li>
                            <li class="{{ $currentStep > 3 ? 'active' : '' }}">Data Pengalaman Kerja</li>
                            <li class="{{ $currentStep > 4 ? 'active' : '' }}">Upload Foto</li>
                            <li class="{{ $currentStep > 5 ? 'active' : '' }}">Jadwal Wawancara</li>
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
                                                        <input type="text" class="form-control"  value="{{ old('nama') }}" name="nama" placeholder="Nama lengkap sesuai KTP" maxlength="40">
                                                        @error('nama')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('nik') has-error @enderror">
                                                    <label for="inputEmail" class="col-sm-3 col-form-label">Nomer KTP/NIK</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nik"  value="{{ old('nik') }}" maxlength="16" placeholder="Nomer KTP" maxlength="16" >
                                                        @error('nik')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('tempat_lahir') has-error @enderror">
                                                    <label for="inputName2" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"  value="{{ old('tempat_lahir') }}" name="tempat_lahir" placeholder="Tempat Lahir sesuai KTP">
                                                        @error('tempat_lahir')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row @error('tgl_lahir') has-error @enderror">
                                                    <label  class="col-sm-3">Tanggal Lahir</label>
                                                    @livewire('pikaday')
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
                                                <div class="form-group" id="status_kawin">
                                                    <label  class="col-sm-3">Status Kawin</label>
                                                    <div class="input-group">
                                                        <label class="radio-inline" for="kawin">
                                                            <input type="radio" id="kawin" name="kawin_id" value="1" required="true">
                                                            <span>Kawin</span>
                                                        </label>
                                                        <label class="radio-inline" for="tidak_kawin">
                                                            <input type="radio" id="tidak_kawin" name="kawin_id" value="2" required="true" >
                                                            <span>Tidak Kawin</span>
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class="form-group row @error('agama_id') has-error @enderror">
                                                    <label class="col-sm-3">Agama</label>
                                                    <div class="col-sm-4 kiri">
                                                        <select class="form-control" name="agama_id" {{ old('agama_id') }} >
                                                            <option value="">-- Pilih --</option>
                                                            <option value="1">Islam</option>
                                                            <option value="2">Katolik</option>
                                                            <option value="3">Kristen Protestan</option>
                                                            <option value="4">Hindu</option>
                                                            <option value="5">Budha</option>
                                                            <option value="6">Konghucu</option>
                                                            <option value="7">Lain-lain</option>
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
                                                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat domisili" >
                                                        @error('alamat')
                                                            <span class="help-block"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-3 col-form-label">Nomer HP</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nomer_hp" maxlength="16" value="{{ old('nomer_hp') }}" placeholder="Nomer HP Aktif" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email aktif" >
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
                                                            <input type="text" class="form-control" name="nik" maxlength="16"  value="{{ $item->nik}} "  >

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

                                                    <div class="form-group" id="status_kawin">
                                                        <label  class="col-sm-3">Status Kawin</label>
                                                        <div class="input-group">
                                                            <label class="radio-inline" for="kawin">
                                                                <input type="radio" id="kawin" name="kawin_id" value="1" required="true" {{$item->kawin_id == '1'? 'checked' : ''}}>
                                                                <span>Kawin</span>
                                                            </label>
                                                            <label class="radio-inline" for="tidak_kawin">
                                                                <input type="radio" id="tidak_kawin" name="kawin_id" value="2" required="true" {{$item->kawin_id == '2'? 'checked' : ''}}>
                                                                <span>Tidak Kawin</span>
                                                            </label>
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
                                                            <input type="text" class="form-control" maxlength="16" name="nomer_hp" value="{{ $item->nomer_hp}} " >
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


                        <!-- fieldsets Step2 Data Pendidikan-->
                            @if ($currentStep==2)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Data Pendidikan</h2>
                                    <h3 class="fs-subtitle">Masukkan 1 data saja untuk tiap Strata. Jika terjadi kesalahan, Hapus dan tambahkan data yg benar</h3>
                                        @livewire('landingpage.data-pendidikan-lw',['rand_ak1'=>$rand_ak1])
                                    <hr>
                                    <h3 class="fs-subtitle">Pendidikan Wajib diisi, minimal Pendidikan Terakhir</h3>

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

                        <!-- akhir fieldsets Step2 Data Pendidikan -->

                        <!-- fieldsets Step3 Data Pelatihan-->
                            @if ($currentStep==3)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Data Pelatihan</h2>
                                    <h3 class="fs-subtitle">Masukkan data pelatihan yang pernah diikuti.</h3>
                                        @livewire('landingpage.data-pelatihan-lw',['rand_ak1'=>$rand_ak1])
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
                        <!-- akhir fieldsets Step3 Data Pelatihan -->

                        <!-- fieldsets Step4 Data Pengalaman Kerja-->
                            @if ($currentStep==4)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Data Pengalaman Kerja</h2>
                                    <h3 class="fs-subtitle">Hanya diisi jika pernah bekerja.</h3>
                                    @livewire('landingpage.data-pengalamankerja-lw',['rand_ak1'=>$rand_ak1])
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

                        <!-- akhir fieldsets Step4 Data Pengalaman Kerja -->

                        <!-- fieldsets Step5 Upload Foto-->
                            @if ($currentStep==5)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Upload Foto KTP dan Passfoto 3x4</h2>
                                    <h3 class="fs-subtitle">Ukuran maksimal foto 1 mega.</h3>
                                    @livewire('landingpage.data-foto-lw',['rand_ak1'=>$rand_ak1])
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


                        <!-- akhir fieldsets Step6 Upload Foto -->

                        <!-- fieldsets Step6 Jadwal Wawancara-->
                            @if ($currentStep==6)
                            <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                @if(!$sudah_pilih_jadwal)
                                    <h2 class="fs-title">Pilih Slot Pagi(08:00-11:30) atau Siang (13:00-15:00) </h2>

                                    @livewire('landingpage.data-wawancara-lw',['rand_ak1'=>$rand_ak1])
                                @else
                                    <h2 class="fs-title">Jadwal Pengambilan Kartu</h2>
                                    <h3 class="fs-subtitle">Jadwal dipakai untuk estimasi kedatangan agar pelayanan bisa optimal</h3>
                                    @livewire('landingpage.show-jadwal-lw',['rand_ak1'=>$rand_ak1])
                                @endif
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
                        <!-- akhir fieldsets Step6 Jadwal Wawancara -->

                        <!-- fieldsets Step7 Preview dan Simpan-->
                            @if ($currentStep==7)
                                <fieldset style="display: block; left: 0%; opacity: 1; transform: scale(1); position: absolute;">
                                    <h2 class="fs-title">Preview Semua Data</h2>
                                    <h3 class="fs-subtitle">Mengecek data sebelum diajukan</h3>
                                    @livewire('landingpage.data-preview-lw',['rand_ak1'=>$rand_ak1])
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


