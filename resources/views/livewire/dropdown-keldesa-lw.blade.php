<div>
    <div class="form-group row">
        <label class="col-sm-3">Kecamatan</label>
        <div class="col-sm-9 kiri">
            <select wire:model.lazy="selectedKecamatan" class="form-control" name=kecamatan_id>
                <option value="" selected>-Pilih Kecamatan-</option>
                @foreach($kecamatan as $itemkec)
                    {{-- <option value="{{ sprintf("%02d",$itemkec['kecamatan_id'])}}">{{ $itemkec['nama_kecamatan'] }}</option> --}}
                    <option value="{{ sprintf("%02d",$itemkec['kecamatan_id'])}}">{{ $itemkec['nama_kecamatan'] }}</option>
                    {{-- <option value="{{ $itemkec['kecamatan_id']}}" {{ $skecamatan_id == $itemkec['kecamatan_id'] ? 'selected="selected"' : '' }}>{{ $itemkec['nama_kecamatan'] }}</option> --}}
                @endforeach
            </select>
        </div>
    </div>



    <div class="form-group row">
        <label class="col-sm-3">Kel./Desa</label>
        <div class="col-sm-9 kiri">
            <select class="form-control" wire:model.lazy="keldesa_id" name="keldesa_id">
                <option value="" selected>-Pilih Kelurahan/Desa</option>

                @if (!is_null($selectedKecamatan))
                    @foreach($keldesa as $itemkel)

                        {{-- sprintf untuk menambah leading zero --}}
                        <option value="{{ sprintf("%06d",$itemkel['id_keldesa_gabungan']) }}">{{ $itemkel['nama_keldesa'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
