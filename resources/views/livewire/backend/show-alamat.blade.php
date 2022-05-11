    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Alamat</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td width="30%">Alamat/Domisili
                            @if($errors->has('pesan_alamat_selesaikan'))
                                <br><em class="text-danger">
                                    {{ $errors->first('pesan_alamat_selesaikan') }}
                                </em>
                            @endif
                        </td>
                        <td width="70%">
                            @if ($alamat_edit)
                                <input type="text" class="form-control"     name="alamat" wire:model.lazy="alamat" wire:keydown.enter="updateAlamat">
                            @else
                                <span wire:click="editAlamat()"  > {{ $alamat  }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Kecamatan
                            @if($errors->has('pesan_kecamatan_selesaikan'))
                                <br><em class="text-danger">
                                    {{ $errors->first('pesan_kecamatan_selesaikan') }}
                                </em>
                            @endif
                        </td>

                        <td width="70%">
                            @if ($kecamatan_edit)
                            <select wire:model.lazy="kecamatan_id" class="form-control" name=kecamatan_id>
                                <option value="" selected>-Pilih Kecamatan-</option>
                                @foreach($kecamatan as $itemkec)
                                    {{-- <option value="{{ sprintf("%02d",$itemkec['kecamatan_id'])}}">{{ $itemkec['nama_kecamatan'] }}</option> --}}
                                    <option value="{{ sprintf("%02d",$itemkec->kecamatan_id)}}">{{ $itemkec->nama_kecamatan }}</option>
                                    {{-- <option value="{{ $itemkec['kecamatan_id']}}" {{ $skecamatan_id == $itemkec['kecamatan_id'] ? 'selected="selected"' : '' }}>{{ $itemkec['nama_kecamatan'] }}</option> --}}
                                @endforeach
                            </select>
                      @else
                          <span wire:click="editKecamatan()">{{ $nama_kecamatan }}</span>
                      @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Kelurahan/Desa
                            @if($errors->has('pesan_keldesa_selesaikan'))
                                <br><em class="text-danger">
                                    {{ $errors->first('pesan_keldesa_selesaikan') }}
                                </em>
                            @endif
                        </td>
                        <td width="70%">
                            @if ($keldesa_edit||$kecamatan_edit)
                                <select class="form-control" wire:model.lazy="keldesa_id" name="keldesa_id">
                                    <option value="" selected>-Pilih Kelurahan/Desa</option>
                                    @if (!is_null($kecamatan_id))
                                        @foreach($keldesa as $itemkel)
                                            {{-- sprintf untuk menambah leading zero --}}
                                            <option value="{{ sprintf("%06d",$itemkel->id_keldesa_gabungan) }}">{{ $itemkel->nama_keldesa }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @else
                                <span wire:click="editKeldesa()">{{ $nama_keldesa }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center " >

            </div>
        </div><!-- /.box-body -->


    </div>

