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
                            <input type="hidden" name="dataPelatihan[jenis_pelatihan]"
                                   wire:model.lazy="dataPelatihan.{{$index}}.jenis_pelatihan" />
                            {{ $dataItem['jenis_pelatihan'] }}
                        @else
                            <input type="text" name="dataPelatihan[jenis_pelatihan]"
                                   class="form-control" wire:model.lazy="dataPelatihan.{{$index}}.jenis_pelatihan" />
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
      //inline script
      //event : livewire:load
      // parameter kedua adalah functionnya
      document.addEventListener("livewire:load", () => {
        let el = $('.select2')
        initSelect()

        //Livewire Hook gives us the opportunity to execute javascript during certain events.
        // message.processed
        // Called after Livewire processes all side effects (including DOM-diffing) from a message
        Livewire.hook('message.processed', (message, component) => {
          initSelect()
        })

        //Livewire.on Listening for Events in Javascript
        Livewire.on('setCategoriesSelect', values => {
          el.val(values).trigger('change.select2')
        })

        el.on('change', function (e) {

            @this.set('dataPelatihan.'+el.attr('name')+'.jenis_pelatihan', el.select2("val"))


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