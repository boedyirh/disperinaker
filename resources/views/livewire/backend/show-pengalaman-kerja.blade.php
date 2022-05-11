<div class="row marginsamping">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Pengalaman Kerja</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th width=5% style="width: 10px">#</th>
                <th width=45% class="text-center">Perusahaan/Lembaga</th>
                <th width=25% >Jabatan</th>
                <th width=10% class="text-center">Tahun</th>
                <th width=15% style="width: 40px">Berkas</th>
              </tr>
              @if($data_pekerjaan == NULL)
                <tr>
                  <td colspan="5" class="text-center">Tidak ada data Pengalaman Kerja</td>
                </tr>
              @else
                @foreach ($dataPekerjaan as $index => $dataItem)
                  <tr>
                    <td class="text-center">
                      <input type="checkbox" wire:click="toggleDipakai({{ $index }})" {{ ($dataItem['dipakai'])?"checked":"" }}>
                    </td>
                    @if($dataItem['pekerjaan_edit'])
                    <td>
                        <input type="text" class="form-control" wire:model.defer="dataPekerjaan.{{$index}}.nama_perusahaan" wire:keydown.enter="updatePekerjaan({{ $index }})" maxlength="55">
                        @if($errors->has('pesan_selesaikan.' . $index))
                            <em class="text-danger">
                                {{ $errors->first('pesan_selesaikan.' . $index) }}
                            </em>
                        @endif
                    </td>
                    <td>
                      <input type="text" class="form-control" wire:model.defer="dataPekerjaan.{{$index}}.jabatan" wire:keydown.enter="updatePekerjaan({{ $index }})" maxlength="55">
                    </td>
                    <td>
                      <input type="text" class="form-control" wire:model.defer="dataPekerjaan.{{$index}}.tahun" wire:keydown.enter="updatePekerjaan({{ $index }})" maxlength="55">
                    </td>
                    @else
                      <td><span wire:click="editPekerjaan({{ $index }})">{{ $dataItem['nama_perusahaan'] }}</span></td>
                      <td><span wire:click="editPekerjaan({{ $index }})">{{ $dataItem['jabatan'] }}</span></td>
                      <td><span wire:click="editPekerjaan({{ $index }})">{{ $dataItem['tahun'] }}</span></td>
                      <td><a href="{{ url('storage/file_pengalamankerja/'.$dataItem['file_pendukung']) }}" target="_blank">{{ $dataItem['file_pendukung'] }} </a></td>

                    @endif
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>