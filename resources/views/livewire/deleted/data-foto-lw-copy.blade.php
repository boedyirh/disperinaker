<div>

    <div class="row">
        @php
            $cek_foto = App\Models\DataFotoModel::checkFoto($rand_ak1);
        @endphp

        <div class="col-sm-6">
            @if($cek_foto)
                <div class="imagecontainer">
                    <img src="{{ url('storage/foto_ktp/'.$daftar_foto->foto_ktp) }}" width="300" height="200" class="border" alt="Logo" >
                </div>
            @else
                <div class="imagecontainer">
                    <img src="{{ url('img/blank-img2.png') }}"  width="400" height="200"  class="border" alt="Foto KTP" >
                </div>
            @endif

            <h5>Foto KTP (wajib)</h5>
            <input type="file"  id="foto_ktp{{ $iteration++ }}"  class="form-control center"  wire:model="foto_ktp" >
            @error('foto_ktp')
                <span class="help-block text-danger "> {{ $message }}</span>
            @enderror
            <p class="help-block">Maksimal ukuran file 2 Mega, Format .jpg, .png, .jpeg.</p>
        </div>
        <div class="col-sm-6">
            @if($cek_foto)
            <div class="imagecontainer">
                <img src="{{ url('storage/foto_diri/'.$daftar_foto->foto_diri) }}" width="150" height="200" class="border" alt="Logo">
            </div>
            @else
            <div class="imagecontainer">
                <img src="{{ url('img/blank-img.jpg') }}"  width="200" height="200"  class="border" alt="Foto KTP">
            </div>
            @endif
        <h5>Foto diri 3x4 (wajib)</h5>
            <input type="file"    id="foto_diri{{ $iteration++ }}" class="form-control center"  wire:model="foto_diri">
            @error('foto_diri')
                <span class="help-block text-danger"> {{ $message }}</span>
            @enderror
            <p class="help-block ">Maksimal ukuran file 2 Mega, Format .jpg, .png, .jpeg.</p>
        </div>
    </div>


    <div class="col-md-12 text-center">
        <button class="btn-sm tambah-button"> Upload Foto</button>
        <p class="help-block ">Jika ingin mengganti foto, harus dua-duanya diupload ulang.</p>
    </div>




</div>

