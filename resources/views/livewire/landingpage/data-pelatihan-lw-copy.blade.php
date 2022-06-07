<div class="box">
    <table class="table table-striped fixed">
        <thead>
            <tr>
                <th class="text-center">Jenis Pelatihan</th>
                <th class="text-center">Nama Instansi</th>
                <th class="text-center" style="width: 70px;">Tahun</th>
                <th class="text-center">Upload Sertifikat</th>
                <th class="text-center">Langkah/Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tbody>

                @foreach ($dataPelatihan as $index => $dataItem)
                <tr>
                    <td>

                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPelatihan[{{$index}}][rand_ak1_pelatihan]"
                                   wire:model.lazy="dataPelatihan.{{$index}}.rand_ak1_pelatihan" />
                            @if($dataItem['jenis_pelatihan'])
                            <?php $nama_jenis_pelatihan  = App\Models\DropdownModel::getJenisPelatihan($dataItem['jenis_pelatihan']); ?>
                                  {{ $nama_jenis_pelatihan->label_dropdown  }}
                            @endif
                        @else
                            <div wire:ignore>
                                <select id="categories" name="dataPelatihan[{{$index}}][jenis_pelatihan]"
                                        class="form-control select2 {{ $errors->has('dataPelatihan') ? ' is-invalid' : '' }}"
                                        wire:model.lazy="dataPelatihan.{{$index}}.jenis_pelatihan">
                                    <option value="">-Pilih Pelatihan-</option>
                                    @foreach($d_jenisPelatihan as $item)
                                        <option value="{{ $item['value_dropdown']}}">{{ $item['label_dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('pesan_selesaikan.' . $index))
                            <em class="invalid-feedback">
                                {{ $errors->first('pesan_selesaikan.' . $index) }}
                            </em>
                        @endif
                        @endif
                    </td>

                    <td>
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPelatihan[lembaga_pelatihan]"
                                   wire:model.lazy="dataPelatihan.{{$index}}.lembaga_pelatihan" />
                            {{ $dataItem['lembaga_pelatihan'] }}
                        @else
                            <input type="text" name="dataPelatihan[lembaga_pelatihan]"
                                   class="form-control" wire:model.defer="dataPelatihan.{{$index}}.lembaga_pelatihan" />
                        @endif
                    </td>

                    <td class="text-center">
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPelatihan[tahun]"
                                   wire:model.lazy="dataPelatihan.{{$index}}.tahun" />
                            {{ $dataItem['tahun'] }}
                        @else
                            <input type="text" maxlength="4" name="dataPelatihan[tahun]"
                                   class="form-control" style="width: 70px;" wire:model.defer="dataPelatihan.{{$index}}.tahun" />
                        @endif
                    </td>
                    <td>
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPelatihan[file_pendukung]"
                                   wire:model.lazy="dataPelatihan.{{$index}}.file_pendukung" />
                            {{ $dataItem['file_asli'] }}
                        @else
                            <input type="file" name="dataPelatihan[file_pendukung]"
                                   class="form-control" wire:model.defer="dataPelatihan.{{$index}}.file_pendukung" />
                        @endif
                    </td>

                    <td class="text-center">
                        @if($dataItem['is_saved'])
                            {{-- <button class="btn btn-sm btn-primary btn-space"
                                    wire:click.prevent="editPelatihan({{$index}})">
                                Edit
                            </button> --}}

                        @elseif($dataItem['jenis_pelatihan'])
                        <button class="btn btn-sm btn-success mr-1"
                                    wire:click.prevent="savePelatihan({{$index}})">
                                Simpan
                            </button>
                        @endif

                        <button class="btn btn-sm btn-danger"
                                wire:click.prevent="removePelatihan({{$index}})"> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach


            </tbody>


        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn-sm tambah-button" wire:click.prevent="addPelatihan"> Tambah Data Pelatihan</button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
      document.addEventListener("livewire:load", () => {
        let el = $('#categories')
        initSelect()

        Livewire.hook('message.processed', (message, component) => {
          initSelect()
        })

        Livewire.on('setCategoriesSelect', values => {
          el.val(values).trigger('change.select2')
        })

        el.on('change', function (e) {
            @this.set('product.categories', el.select2("val"))
        })

        function initSelect () {
          el.select2({
            placeholder: '{{__('Select your option')}}',
            allowClear: !el.attr('required'),
          })
        }
      })
    </script>
@endpush