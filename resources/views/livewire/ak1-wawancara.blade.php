<div>

    <div class="col-md-12">
        ak1-wawancara.blade.php livewire
        <div class="box">
            @if (session('pesan_1'))
            <script type="text/javascript">
                    window.setTimeout(function() {
                        $(".alert").fadeTo(600, 0).slideUp(600, function() {
                            $(this).hide();
                        });
                    }, 1000);
                </script>
                <div class="alert alert-success alert-dismissible" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('pesan_1') }}
                </div>
                @endif
                <div class="box-body">
                    <div class="box-header">
                        <div class="box-tools">

                            <div class="input-group input-group-sm hidden-xs" style="width: 200px;">
                                <input wire:model.debounce.400ms="searchTerm" type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button wire:click="kosongkan()" type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>

                        <table class="table table-bordered table-striped">
                            <thead >
                                <tr class="biru">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tahun Program Kerja</th>
                                    <th class="text-center">Jumlah Hari kerja</th>
                                    <th class="text-center">Jumlah Slot</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no =0;
                                    @endphp
                                @foreach ($daftar_wawancara as $dataItem)
                                    <tr>
                                        <td class="text-center"> {{ ++$no +(($page-1)*$perpage)  }}</td>
                                        {{-- <td> {{ $dataItem->hari}}, {{ date('d-m-Y',strtotime($dataItem->tgl_kegiatan))}}</td> --}}
                                        <td> {{ $dataItem->periode}}</td>
                                        <td class="text-center">{{ $dataItem->jumlah_slot}}</td>
                                        <td class="text-center">{{ $dataItem->jumlah_slot}}</td>

                                        {{-- <td class="text-center"> {!! $dataItem->periode  ? '<span class="badge bg-blue">Terlaksana</span>':'-' !!} </td> --}}
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Aksi</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="/wawancara/edit/{{ $dataItem->rand_wawancara}}">Edit</a></li>
                                                    <li><a href="#" data-toggle="modal" data-record="{{ $dataItem->rand_wawancara }}"  data-nama="{{ $dataItem->kategori }}"data-target=".kunci-wawancara">Kunci</a></li>
                                                    <li><a href="#" data-toggle="modal" data-record="{{ $dataItem->rand_wawancara }}"  data-nama="{{ $dataItem->kategori }}"data-target=".delete-wawancara">Delete</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Manage Peserta</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        Total Record : {{ $total_record }}
                        {{ $daftar_wawancara->links('pagination-links') }}
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary btn-sm m-b" data-toggle="modal" data-target="#addWawancara">
                                <i class="fa fa-plus"></i> Tambah Slot Wawancara Setahun
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div wire:ignore.self class="modal fade" id="addWawancara" tabindex="-1" role="dialog" aria-labelledby="TambahWawancara" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="store" id="form_isi">
                    <div class="modal-header">
                        <h3 class="modal-title" id="TambahWawancara">Tambah Slot Wawancara setahun</h3>
                    </div>
                <div class="modal-body">
                        <form method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tahun Program kerja</label>
                                <div class="form-group">

                                    <input type="text" class="form-control" wire:model.lazy="tahun" name="tahun" placeholder="Misal : 2022">
                                    @error('tahun') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            {{-- <div class="input-group form-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar" ></i>
                                </div>
                                <input
                                wire:model="tgl_kegiatan"
                                type="text" class="form-control " placeholder="Due Date" autocomplete="off" id="datepicker"
                                onchange="this.dispatchEvent(new InputEvent('input'))"
                                >
                            </div>--}}
                    </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="store()"   class="btn btn-primary close-modal">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

