
        <div class="col-md-6">
            <input wire:model.lazy="tgl_lahir" type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tahun-Bulan-Tanggal"
                   class="form-control @error('tgl_lahir') is-invalid @enderror"/>
            @error('tgl_lahir')
            <span class="help-block" role="alert">{{ $message }}</span>
            @enderror


        </div>




