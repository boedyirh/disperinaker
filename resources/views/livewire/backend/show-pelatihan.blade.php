<div class="row marginsamping">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Pelatihan/Skill</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-striped">
            <tbody><tr>
              <th width=5% style="width: 10px">#</th>
              <th width=30% class="text-center">Keahlian</th>
              <th width=35% class="text-center">Lembaga Pelatihan</th>
              <th width=15% class="text-center">Tahun</th>
              <th width=10% style="width: 40px">Berkas</th>
            </tr>
            @if($data_pelatihan == NULL)
              <tr>
                <td colspan="5" class="text-center">Tidak ada data Pelatihan</td>
              </tr>
            @else

                @foreach ($dataPelatihan as $index => $dataItem)
                  <tr>
                      <td class="text-center">
                          <input type="checkbox" wire:click="toggleDipakai({{ $index }})" {{ ($dataItem['dipakai'])?"checked":"" }}>
                      </td>
                      @if($dataItem['pelatihan_edit'])
                        <td>
                           {{-- <input type="text" class="form-control" wire:model.defer="dataPelatihan.{{$index}}.nama_jenispelatihan" wire:keydown.enter="updatePelatihan({{ $index }})" maxlength="55"> --}}

                            <select name="" class="form-control" wire:model.defer="dataPelatihan.{{$index}}.jenis_pelatihan" wire:change="updatePelatihan({{ $index }})">
                                <option value="">Pilih Pelatihan</option>
                                @foreach($d_jenisPelatihan as $item)
                                    <option value="{{ $item['value_dropdown']}}">{{ $item['label_dropdown'] }}</option>
                                @endforeach
                            </select>


                           @if($errors->has('pesan_selesaikan.' . $index))
                               <em class="text-danger">
                                   {{ $errors->first('pesan_selesaikan.' . $index) }}
                               </em>
                           @endif
                        </td>

                        <td><input type="text" class="form-control" wire:model.defer="dataPelatihan.{{$index}}.lembaga_pelatihan" wire:keydown.enter="updatePelatihan({{ $index }})" maxlength="55"></td>

                        <td><input type="text" class="form-control" wire:model.defer="dataPelatihan.{{$index}}.tahun" wire:keydown.enter="updatePelatihan({{ $index }})" maxlength="4"></td>
                        <td class="text-center">  </td>
                      @else
                        <td><span wire:click="editPelatihan({{ $index }})">{{ $dataItem['nama_jenispelatihan'] }}</span></td>
                        <td ><span wire:click="editPelatihan({{ $index }})">{{ $dataItem['lembaga_pelatihan'] }}</span></td>
                        <td class="text-center"><span wire:click="editPelatihan({{ $index }})">{{ $dataItem['tahun'] }}</span></td>
                        <td><a href="{{ url('storage/file_pelatihan/'.$dataItem['file_pendukung']) }}" target="_blank">{{ $dataItem['file_pendukung'] }} </a></td>

                      @endif
                  </tr>
              @endforeach
            @endif


          </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
