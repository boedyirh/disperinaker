<div>
    <div class="col-md-12">
        ak1-siapcetak.blade.php livewire
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
            <div class="box">

                <div class="row box-header">
                    <div class="col-md-2" style="padding-top:10px;">
                        <select name="" wire:model="filter_tahun" wire:change="updateFilterStatus"  style="height: 28px;" >
                            <option value=''>Semua Tahun</option>
                            <option value='2022'>Tahun 2022</option>
                            <option value='2023'>Tahun 2023</option>
                            <option value='2024'>Tahun 2024</option>
                            <option value='2025'>Tahun 2025</option>
                            <option value='2026'>Tahun 2026</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top:10px;">
                        <select name="" wire:model="filter_bulan" wire:change="updateFilterStatus"  style="height: 28px;" >
                            <option value=''>Semua bulan</option>
                            <option value=1>Januari</option>
                            <option value=2>Februari</option>
                            <option value=3>Maret</option>
                            <option value=4>April</option>
                            <option value=5>Mei</option>
                            <option value=6>Juni</option>
                            <option value=7>Juli</option>
                            <option value=8>Agustus</option>
                            <option value=9>September</option>
                            <option value=10>Oktober</option>
                            <option value=11>November</option>
                            <option value=12>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="padding-top:10px;">
                        <select name="" wire:model="filter_id" wire:change="updateFilterStatus"  style="height: 28px;" >
                            <option value="">All Status</option>
                            <option value=1>Belum diproses</option>
                            <option value=2>Sudah Lewat tapi Belum diambil</option>
                            <option value=3>Sudah Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-2 text-center" style="padding-top:10px;">
                        <div  wire:loading>Sedang proses ...</div>
                    </div>
                    <div class="col-md-3 " style="padding-top:10px;">
                        <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                            <input wire:model.debounce.400ms="searchTerm" type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button wire:click="kosongkan()" type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- end of box-header -->

                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="biru">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Desa/Kelurahan</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Tanggal Pengambilan</th>
                                <th class="text-center">Jadwal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no =0;
                            @endphp
                            @foreach ($daftar_pengajuan as $dataItem)
                                <tr>
                                    <td class="text-center"> {{ ++$no +(($page-1)*$perpage)  }}</td>
                                    <td> {{ $dataItem->nama }}</td>
                                    <td> {{ $dataItem->nama_kecamatan }} </td>
                                    <td> {{ $dataItem->nama_keldesa }} </td>
                                    <td> {{ $dataItem->alamat}} </td>
                                    <td class="text-center">{{ date("d-m-Y",strtotime($dataItem->tanggal_jadwal))}}</td>
                                    <td class="text-center">{{  $dataItem->hari_jadwal }}, {{ $dataItem->jam_jadwal }}</td>
                                    {{-- <td class="text-center"> {!! $dataItem->status  ? '<span class="badge bg-blue">Terlaksana</span>':'<span class="badge bg-brown">OK</span>' !!} </td> --}}
                                    <td class="text-center"> {!!  labelPengajuan($dataItem->status_id) !!} </td>
                                    <td class="text-center">  <a href="/verifikasi/{{  $dataItem->rand_ak1 }}" class="btn btn-primary">Verifikasi</a> </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Total Record : {{ $total_record }}
                    {{ $daftar_pengajuan->links('pagination-links') }}
                    <div class="col-md-12 text-center">
                        <a href="/ak1/pendaftaran" class="btn btn-primary btn-sm m-b "><i class="fa fa-plus"></i> Tambah Pengajuan</a>
                    </div>
                </div> <!-- end of box-body -->
            </div><!-- end of box -->
    </div>
</div>
