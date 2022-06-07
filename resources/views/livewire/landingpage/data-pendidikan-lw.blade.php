<div class="box">
    <div>
        <table class="table table-striped fixed">
            <thead>
                <tr>
                    <th class="text-center">Tingkat Pendidikan</th>
                    <th class="text-center">Nama Institusi</th>
                    <th class="text-center">Jurusan</th>
                    <th class="text-center" style="width: 70px;">Lulus Tahun</th>
                    <th class="text-center">Upload Ijazah</th>
                    <th class="text-center">Langkah/Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tbody>

                    @foreach ($dataPendidikan as $index => $dataItem)
                    <tr>
                        <td>
                            @if($dataItem['is_saved'])
                                <input type="hidden" name="dataPendidikan[{{$index}}][rand_ak1_pendidikan]"
                                    wire:model.lazy="dataPendidikan.{{$index}}.rand_ak1_pendidikan" />
                                @if($dataItem['tingkat_pendidikan'])
                                    <?php $nama_tingkat_pendidikan  = App\Models\DropdownModel::getTingkatPendidikan($dataItem['tingkat_pendidikan']); ?>
                                    {{ $nama_tingkat_pendidikan->label_dropdown  }}
                                @endif
                            @else
                                <select name="dataPendidikan[{{$index}}][tingkat_pendidikan]"
                                        class="form-control{{ $errors->has('dataPendidikan') ? ' is-invalid' : '' }}"
                                        wire:model.lazy="dataPendidikan.{{$index}}.tingkat_pendidikan">
                                    <option value="">-Pilih Pendidikan-</option>
                                    @foreach($d_tingkatpendidikan as $item)
                                        <option value="{{ $item['value_dropdown']}}">{{ $item['label_dropdown'] }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('pesan_selesaikan.' . $index))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('pesan_selesaikan.' . $index) }}
                                    </em>
                                @endif
                            @endif
                        </td>

                        <td>
                            @if($dataItem['is_saved'])
                                <input type="hidden" name="dataPendidikan[nama_institusi]"
                                    wire:model.lazy="dataPendidikan.{{$index}}.nama_institusi" />
                                {{ $dataItem['nama_institusi'] }}
                            @else
                                <input type="text" name="dataPendidikan[nama_institusi]"
                                    class="form-control" wire:model.defer="dataPendidikan.{{$index}}.nama_institusi" />
                            @endif
                        </td>
                        <td>
                            @if($dataItem['is_saved'])
                                <input type="hidden" name="dataPendidikan[jurusan]"
                                    wire:model.lazy="dataPendidikan[{{$index}}]jurusan" />
                                {{ $dataItem['jurusan'] }}
                            @else
                                <input type="text" name="dataPendidikan[jurusan]"
                                    class="form-control" wire:model.defer="dataPendidikan.{{$index}}.jurusan" />
                            @endif
                        </td>
                        <td class="text-center">
                            @if($dataItem['is_saved'])
                                <input type="hidden" name="dataPendidikan[tahun_lulus]"
                                    wire:model.lazy="dataPendidikan.{{$index}}.tahun_lulus" />
                                {{ $dataItem['tahun_lulus'] }}
                            @else
                                <input type="text" maxlength="4" name="dataPendidikan[tahun_lulus]"
                                    class="form-control" style="width: 70px;" wire:model.defer="dataPendidikan.{{$index}}.tahun_lulus" />
                            @endif
                        </td>
                        <td>
                            @if($dataItem['is_saved'])
                                <input type="hidden" name="dataPendidikan[file_pendukung]"
                                    wire:model.lazy="dataPendidikan.{{$index}}.file_pendukung" />
                                {{ $dataItem['file_asli'] }}
                            @else
                                <input type="file" name="dataPendidikan[file_pendukung]"
                                    class="form-control" wire:model.defer="dataPendidikan.{{$index}}.file_pendukung" />
                            @endif
                        </td>

                        <td class="text-center">
                            @if($dataItem['is_saved'])
                                {{-- <button class="btn btn-sm btn-primary btn-space"
                                        wire:click.prevent="editPendidikan({{$index}})">
                                    Edit
                                </button> --}}

                            @elseif($dataItem['tingkat_pendidikan'])
                                <button class="btn btn-sm btn-success mr-1" title="Simpan"
                                        wire:click.prevent="savePendidikan({{$index}})">
                                        Simpan
                                </button>
                            @endif

                            <button class="btn btn-sm btn-danger" title="Hapus"
                                    wire:click.prevent="removePendidikan({{$index}})">Delete</button>
                        </td>
                    </tr>
                    @endforeach


                </tbody>


            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn-sm tambah-button" wire:click.prevent="addPendidikan"> Tambah Data Pendidikan</button>
        </div>
    </div>
</div>
