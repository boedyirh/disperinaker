<div class="box">
    <table class="table table-striped fixed">
        <thead>
            <tr>
                <th class="text-center">Nama Perusahaan</th>
                <th class="text-center">Bidang Kerja</th>
                <th class="text-center">Posisi/Jabatan</th>
                <th class="text-center" style="width: 70px;">Tahun</th>
                <th class="text-center">Berkas Pendukung</th>
                <th class="text-center">Langkah/Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tbody>
                @foreach ($dataPengalamankerja as $index => $dataItem)
                <tr>
                    <td>
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPengalamankerja[nama_perusahaan]"
                                   wire:model.lazy="dataPengalamankerja.{{$index}}.nama_perusahaan" />
                            {{ $dataItem['nama_perusahaan'] }}
                        @else
                            <input type="text" name="dataPengalamankerja[nama_perusahaan]"
                                   class="form-control" wire:model.lazy="dataPengalamankerja.{{$index}}.nama_perusahaan" />
                        @endif
                    </td>


                    <td>
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPengalamankerja[bidang_usaha]"
                                   wire:model.lazy="dataPengalamankerja.{{$index}}.bidang_usaha" />
                            {{ $dataItem['bidang_usaha'] }}
                        @else
                            <input type="text" name="dataPengalamankerja[bidang_usaha]"
                                   class="form-control" wire:model.lazy="dataPengalamankerja.{{$index}}.bidang_usaha" />
                        @endif
                    </td>
                    <td>
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPengalamankerja[jabatan]"
                                   wire:model.lazy="dataPengalamankerja.{{$index}}.jabatan" />
                            {{ $dataItem['jabatan'] }}
                        @else
                            <input type="text" name="dataPengalamankerja[jabatan]"
                                   class="form-control" wire:model.lazy="dataPengalamankerja.{{$index}}.jabatan" />
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPengalamankerja[tahun]"
                                   wire:model.lazy="dataPengalamankerja.{{$index}}.tahun" />
                            {{ $dataItem['tahun'] }}
                        @else
                            <input type="text" maxlength="4" name="dataPengalamankerja[tahun]"
                                   class="form-control" style="width: 70px;" wire:model.lazy="dataPengalamankerja.{{$index}}.tahun" />
                        @endif
                    </td>
                    <td>
                        @if($dataItem['is_saved'])
                            <input type="hidden" name="dataPengalamankerja[file_pendukung]"
                                   wire:model.lazy="dataPengalamankerja.{{$index}}.file_pendukung" />
                            {{ $dataItem['file_asli'] }}
                        @else
                            <input type="file" name="dataPengalamankerja[file_pendukung]"
                                   class="form-control" wire:model.defer="dataPengalamankerja.{{$index}}.file_pendukung" />
                        @endif
                    </td>

                    <td class="text-center">
                        @if($dataItem['is_saved'])
                            {{-- <button class="btn btn-sm btn-primary btn-space"
                                    wire:click.prevent="editPengalamankerja({{$index}})">
                                Edit
                            </button> --}}

                        @elseif($dataItem['nama_perusahaan'])
                        <button class="btn btn-sm btn-success mr-1"
                                    wire:click.prevent="savePengalamankerja({{$index}})">
                                Simpan
                            </button>
                        @endif

                        <button class="btn btn-sm btn-danger"
                                wire:click.prevent="removePengalamankerja({{$index}})"> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach


            </tbody>


        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn-sm tambah-button" wire:click.prevent="addPengalamankerja"> Tambah Data Pengalaman Kerja</button>
        </div>
    </div>
</div>

