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
                <th width=5% style="width: 10px">#</th>
                <th width=45% class="text-center">Institusi/Sekolah</th>
                <th width=15% class="text-center">Tahun</th>
                <th width=20% >Strata</th>
                <th width=15% style="width: 40px">Berkas</th>
            </tr>

            @if($data_pendidikan == NULL)
              <tr>
                <td colspan="6" class="text-center">Tidak ada data Pendidikan</td>
              </tr>
            @else

                @foreach ($dataPendidikan as $index => $dataItem)
                  <tr>
                      <td class="text-center">
                            <input type="checkbox" wire:click="toggleDipakai({{ $index }})" {{ ($dataItem['dipakai'])?"checked":"" }}>
                      </td>
                      @if($dataItem['pendidikan_edit'])
                        <td>
                          <input type="text" class="form-control" wire:model.defer="dataPendidikan.{{$index}}.nama_institusi" wire:keydown.enter="updatePendidikan({{ $index }})" maxlength="55">
                          @if($errors->has('pesan_selesaikan.' . $index))
                              <em class="text-danger">
                                  {{ $errors->first('pesan_selesaikan.' . $index) }}
                              </em>
                          @endif
                        </td>
                        <td><input type="text" class="form-control" wire:model.defer="dataPendidikan.{{$index}}.tahun_lulus" wire:keydown.enter="updatePendidikan({{ $index }})" maxlength="55"></td>
                        <td>
                          <select name="" class="form-control" wire:model.defer="dataPendidikan.{{$index}}.tingkat_pendidikan" wire:change="updatePendidikan({{ $index }})">
                              <option value="">Strata</option>
                              @foreach($d_tingkatpendidikan as $item)
                                  <option value="{{ $item['value_dropdown']}}">{{ $item['label_dropdown'] }}</option>
                              @endforeach
                          </select>
                        </td>
                        <td>{{ $dataItem['file_pendukung'] }}</td>
                      @else
                          <td><span wire:click="editPendidikan({{ $index }})">{{ $dataItem['nama_institusi'] }}</span></td>
                          <td class="text-center"><span wire:click="editPendidikan({{ $index }})">{{ $dataItem['tahun_lulus'] }}</span></td>
                          <td><span wire:click="editPendidikan({{ $index }})">{{ $dataItem['nama_tingkatpendidikan'] }}</span></td>
                          <td><a href="{{ url('storage/file_pendidikan/'.$dataItem['file_pendukung']) }}" target="_blank">{{ $dataItem['file_pendukung'] }} </a></td>
                      @endif

                  </tr>
              @endforeach
            @endif
          </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
