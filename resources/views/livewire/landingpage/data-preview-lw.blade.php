<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Preview Data Diri</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                    <div class="col-sm-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->nama}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Nomer KTP/NIK</label>
                                <div class="col-sm-8">
                                    {{ wordwrap($list_ak1_preview->nik,4,' ',true)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Tempat Lahir</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->tempat_lahir}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Tanggal lahir</label>
                                <div class="col-sm-8">
                                    {{ date('d-m-Y',strtotime($list_ak1_preview->tgl_lahir))}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Jenis Kelamin</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->nama_jeniskelamin}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Tinggi Badan</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->tinggi}} cm.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Berat badan</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->berat}} kg.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Agama</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->nama_agama}}
                                </div>
                            </div>
                        </div> <!--form-horizontal -->
                    </div> <!--col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="nomer_hp" class="col-sm-4 control-label">Kecamatan</label>
                                <div class="col-sm-6">
                                    {{ $list_ak1_preview->nama_kecamatan}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomer_hp" class="col-sm-4 control-label">Kelurahan/Desa</label>
                                <div class="col-sm-6">
                                    {{ $list_ak1_preview->nama_keldesa}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomer_hp" class="col-sm-4 control-label">Alamat</label>
                                <div class="col-sm-6">
                                    {{ $list_ak1_preview->alamat}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomer_hp" class="col-sm-4 control-label">Nomer HP</label>
                                <div class="col-sm-6">
                                    {{ wordwrap($list_ak1_preview->nomer_hp,4,' ',true)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    {{ $list_ak1_preview->email}}
                                </div>
                            </div>
                        </div>
                    </div><!--col-sm-6 -->

            </div> <!--row -->
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Preview Foto</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                    <div class="col-sm-6">
                        <label class="imagecontainer">
                            Foto KTP
                        </label>
                        <div class="imagecontainer">
                            <img src="{{ url('storage/foto_ktp/'.$list_ak1_preview->foto_ktp) }}" width="300" height="200" class="border" alt="Logo">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="imagecontainer">
                             Foto diri 3x4
                        </label>
                        <div class="imagecontainer">
                            <img src="{{ url('storage/foto_diri/'.$list_ak1_preview->foto_diri) }}" width="150" height="200" class="border" alt="Logo">
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Preview Data Pendidikan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tingkat Pendidikan</th>
                            <th class="text-center">Nama Institusi</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Lulus Tahun</th>
                            <th class="text-center">Ijazah</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $no=1?>
                        @foreach ($pendidikanPreview as $index => $dataItem)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td> {{ $dataItem['nama_tingkatpendidikan']}}</td>
                                <td> {{ $dataItem['nama_institusi']}}</td>
                                <td> {{ $dataItem['jurusan']}}</td>
                                <td class="text-center"> {{ $dataItem['tahun_lulus']}}</td>
                                <td class="text-center"> {{ $dataItem['file_asli']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Preview Data Pelatihan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jenis Pelatihan</th>
                            <th class="text-center">Nama Lembaga</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $no=1?>
                        @foreach ($pelatihanPreview as $index => $dataItem)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td> {{ $dataItem['nama_jenispelatihan']}}</td>
                                <td> {{ $dataItem['lembaga_pelatihan']}}</td>
                                <td class="text-center"> {{ $dataItem['tahun']}}</td>

                                <td class="text-center"> {{ $dataItem['file_asli']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Preview Data Pengalaman Kerja</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Bidang Usaha</th>
                            <th class="text-center">Nama Kantor</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Surat Keterangan</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $no=1?>
                        @foreach ($pengalamanKerjaPreview as $index => $dataItem)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td> {{ $dataItem['bidang_usaha']}}</td>
                                <td> {{ $dataItem['nama_perusahaan']}}</td>
                                <td> {{ $dataItem['jabatan']}}</td>
                                <td class="text-center">{{ $dataItem['tahun']}}  </td>
                                <td class="text-center"> {{ $dataItem['file_asli']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
