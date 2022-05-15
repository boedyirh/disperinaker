<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kartu A4</title>

    <style>

@page { margin-top: 10px; }

   .body {
     background-color: white;
     color: black;
     font-size: 70%;
     margin: 0px;
   }
   h4.spasing {
    margin-top:1px;
    margin-bottom: 1px;
    margin-left:10px;
  }

      th.borderall {
        border: 1px solid;
        border-collapse: collapse;
      }
      td.borderall {
        border: 1px solid;
        border-collapse: collapse;
      }

      td.notop-nobottom {
        border:none;
      }

      table.container-header {
        table-layout: fixed;
        width: 700px;
        border-collapse: collapse;
      }
      table.container-inside {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
      }


    </style>
  </head>
  <body>
    <div >
      <table class="container-header">

        <tr>
          <td width=20%>

            <img src="http://disperinaker.test/logopemkab.png" alt="" height="95px" width="89px" />

          </td>
          <td   width=65%>

            <h4 class="spasing">PEMERINTAH KABUPATEN BOJONEGORO</h4>
            <h4 class="spasing">DINAS PERINDUSTRIAN DAN TENAGA KERJA</h4>
            <h4 class="spasing">KARTU TANDA BUKTI PENDAFTARAN PENCARI KERJA</h4>

          </td>
          <td width=15%>
            <div style="padding-top:0px;">
              Formulir AK/1

            </div>

          </td>
        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td     width=32%>Nomer Pendaftaran Pencari Kerja</td>
          <td    width=68%>
            @php
              //$tgl_ini = $tgl_ambil;
              //$nomer_hari = date("d-m-Y");
              $split_nomer_hari = str_split(($tgl_ambil));

              $nomer_urut = $last_agenda;
              $nomer_urut_lz= str_pad($nomer_urut,6,"0",STR_PAD_LEFT);
              $split_nomer_urut = str_split(($nomer_urut_lz));
            @endphp
            <table class="container-inside">
              <tr>
                <td class="borderall" width=5% style="text-align: center">3</td>
                <td  class="borderall" width=5% style="text-align: center">5</td>
                <td  class="borderall" width=5% style="text-align: center">2</td>
                <td  class="borderall" width=5% style="text-align: center">2</td>
                <td width=5% class="notop-nobottom" style="text-align: center"></td>
                <td class="borderall"  width=5% style="text-align: center">{{ $split_nomer_hari[8]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_hari[9]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_hari[5]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_hari[6]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_hari[2]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_hari[3]}}</td>

                <td width=5% class="notop-nobottom" style="text-align: center"></td>
                <td class="borderall"  width=5% style="text-align: center">{{ $split_nomer_urut[0]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_urut[1]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_urut[2]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_urut[3]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_urut[4]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $split_nomer_urut[5]}}</td>
            </table>
          </td>
        </tr>
      </table>
    </div>
    @php
      $nik = str_pad(strtoupper($data_pemohon->nik), 18,'-', STR_PAD_LEFT);
      $data_nik = str_split($nik);
    @endphp
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>No. Induk Kependudukan</td>
          <td width=68%>
            <table class="container-inside">
              <tr>
                  @foreach ( $data_nik as $item)
                    <td  class="borderall" width=5% style="text-align: center">{{ $item }}</td>
                  @endforeach

              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>
            <br>
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Pas Foto
            <br>
            <br>
            <br>
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanda tangan
            <br>
            <br>
            <br>
            <br>
            <br>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pencari Kerja

          </td>
          <td width=68% style="margin-left:0px;">  Ketentuan :
            <ol >
              <li  >Berlaku Nasional.</li>
              <li style="text-align: justify;">Bila ada perubahan data/keterangan lainnya atau telah mendapatkan pekerjaan harap melapor ke Dinas Perindustrian dan Tenaga Kerja paling lambat 1 (satu) minggu setelah tanggal penempatan.</li>
              <li style="text-align: justify;">Apabila pencari kerja yang bersangkutan teah diterima bekerja maka instansi/Perusahaan yang menerima harus mengembalikan AK/1 ini ke Dinas Perindustrian dan Tenaga Kerja.</li>
              <li style="text-align: justify;">Kartu ini berlaku selama 2(dua) tahun dengan keharusan melapor setiap 6 (enam) sekali bagi Pencari Kerja yang mendapatkan penempatan.</li>
            </ol>
          </td>
        </tr>
      </table>
    </div>

    <div>
      <table class="container-header">
        <tr>
          <td width=32%> </td>
          <td width=68%>
            <table class="container-inside">
              <tr>
                <th class="borderall"width=20%>Laporan</th>
                <th class="borderall"width=40%>Tanggal - Bulan - Tahun</th>
                <th class="borderall"width=40%>
                  Tanda tangan Pengantar <br />Kerja/Petugas Pendaftar<br />Cantumkan
                  Nama dan NIP
                </th>
              </tr>
              <tr>
                <td  class="borderall" >Kesatu</td>
                <td  class="borderall" >-</td>
                <td  class="borderall" >-</td>
              </tr>
              <tr>
                <td  class="borderall" >Kedua</td>
                <td  class="borderall" >-</td>
                <td  class="borderall" >-</td>
              </tr>
              <tr>
                <td  class="borderall" >Ketiga</td>
                <td  class="borderall" >-</td>
                <td  class="borderall" >-</td>
              </tr>
            </table>

            <table class="container-inside">
              <tr>
                <td  class="borderall" width=35%>Diterima Penempatan</td>
                <td  class="borderall" width=65%>
                  : ...................................................................

                </td>
              </tr>
              <tr>
                <td  class="borderall" >Tanggal Penempatan</td>
                <td  class="borderall" >
                  : ...................................................................
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    @php
      $panjang_nama = strlen($data_pemohon->nama);
      $nama = str_pad(strtoupper($data_pemohon->nama), 40);
      $baris1  = substr($nama, 0, 20);
      $baris2  = substr($nama, 20, 40);
      $data_nama = str_split(($baris1));
      $data_nama2 = str_split(($baris2));
    @endphp
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Nama Lengkap</td>
          <td width=68%><table class="container-inside">
            <tr>
                @foreach ( $data_nama as $key=>$item)
                  <td  class="borderall" width=5% style="text-align: center">{{ $item }}</td>
                @endforeach

            </tr>
          </table></td>
        </tr>
      </table>
      @if ($panjang_nama>20)
      <table class="container-header">
        <tr>
          <td width=32%> </td>
          <td width=68%><table class="container-inside">
            <tr>
                @foreach ( $data_nama2 as $key=>$item)
                  <td  class="borderall" width=5% style="text-align: center">{{ $item }}</td>
                @endforeach

            </tr>
          </table></td>
        </tr>
      </table>
      @endif

    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Tempat/Tanggal Lahir</td>
          <td width=33%>: {{ $data_pemohon->tempat_lahir }} </td>

          @php
             $hari = date("d-m-Y",strtotime($data_pemohon->tgl_lahir));
             $data_tgl = str_split(($hari));

          @endphp
          <td width=35%>
            <table class="container-inside">
              <tr>
                <td  class="notop-nobottom" width=7% style="text-align: center">Tgl</td>
                <td  class="borderall" width=5% style="text-align: center">{{  $data_tgl[0]}}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $data_tgl[1]}}</td>
                <td  class="notop-nobottom" width=7% style="text-align: center">Bln</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $data_tgl[3] }}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $data_tgl[4] }}</td>
                <td  class="notop-nobottom" width=7% style="text-align: center">Thn</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $data_tgl[8] }}</td>
                <td  class="borderall" width=5% style="text-align: center">{{ $data_tgl[9] }}</td>
            </table>
           </td>
        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Jenis Kelamin</td>
          <td width=33%>: 1. Pria </td>
          <td width=32%>&nbsp;  2. Wanita </td>
          <td width=3%>
            <table class="container-inside">
              <tr>
                <td  class="borderall" style="text-align: center">{{ $data_pemohon->jeniskelamin_id }}</td>
              </tr>
            </table>
        </td>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Status</td>
          <td width=33%>: 1. Kawin </td>
          <td width=32%>&nbsp;  2. Belum Kawin </td>
          <td width=3%>
            <table class="container-inside">
              <tr>
                <td  class="borderall" style="text-align: center">{{ $data_pemohon->kawin_id }}</td>
              </tr>
            </table>
        </td>
        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Agama</td>
          <td width=33%>: 1. Islam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Katholik </td>
          <td width=32%>&nbsp;  3. Protestan &nbsp;&nbsp;&nbsp;&nbsp; 4.Hindu </td>
          <td width=3%> <table class="container-inside">
            <tr>
              <td  class="borderall" style="text-align: center">{{ $data_pemohon->agama_id }}</td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%> </td>
          <td width=33%>: 5. Budha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. Konghucu</td>
          <td width=32%>&nbsp;  7. Lain-lain </td>
          <td width=3%>  </td>

        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Alamat Domisili</td>
          <td width=68%>: {{ $data_pemohon->alamat }}</td>
        </tr>
      </table>
    </div>
    <div>
      <table class="container-header">
        <tr>
          <td width=32%>Nomer Telp/HP</td>
          <td width=68%>: {{ substr($data_pemohon->nomer_hp, 0, 4) . "-" . substr($data_pemohon->nomer_hp, 4,4) . "-" . substr($data_pemohon->nomer_hp, 8,7) }}</td>
        </tr>
      </table>
    </div>
    <table class="container-header">
        <tr>
          <td width= 80%  colspan="3"><b>Pendidikan Formal</b></td>
          <td width= 23%  rowspan="9" style="text-align: center">  Pengantar Kerja/Petugas<br>Antar Kerja<br><br><br><br><br>  Agoestin F. SH., M.Si</td>
        </tr>
          @php
            $data_sd = $data_pendidikan->firstWhere('tingkat_pendidikan',1);
            if($data_sd){
              $nama_sd = $data_sd->nama_institusi;
              $sd_lulus = 'Thn '.$data_sd->tahun_lulus;
            }else {
              $nama_sd ='-';
              $sd_lulus ='-';
            }
            $data_smp = $data_pendidikan->firstWhere('tingkat_pendidikan',2);
            if($data_smp){
              $nama_smp = $data_smp->nama_institusi;
              $smp_lulus = 'Thn '.$data_smp->tahun_lulus;
            }else {
              $nama_smp ='-';
              $smp_lulus ='-';
            }
            $data_sma = $data_pendidikan->firstWhere('tingkat_pendidikan',3);
            if($data_sma){
              $nama_sma = $data_sma->nama_institusi.'/'.$data_sma->jurusan;
              $sma_lulus = 'Thn '.$data_sma->tahun_lulus;
            }else {
              $nama_sma ='-';
              $sma_lulus ='-';
            }

            $data_diploma = $data_pendidikan->firstWhere('tingkat_pendidikan',4);
            if($data_diploma){
              $nama_diploma = $data_diploma->nama_institusi.'/'.$data_diploma->jurusan;
              $diploma_lulus = 'Thn '.$data_diploma->tahun_lulus;


            }else {
              $nama_diploma ='-';
              $diploma_lulus ='-';
            }
            $data_akta = $data_pendidikan->firstWhere('tingkat_pendidikan',5);
            if($data_akta){
              $nama_akta = $data_akta->nama_institusi.'/'.$data_akta->jurusan;
              $akta_lulus = 'Thn '.$data_akta->tahun_lulus;
            }else {
              $nama_akta ='-';
              $akta_lulus ='-';
            }
            $data_pt = $data_pendidikan->firstWhere('tingkat_pendidikan',6);
            if($data_pt){
              $nama_pt = $data_pt->nama_institusi.'/'.$data_pt->jurusan;
              $pt_lulus = 'Thn '.$data_pt->tahun_lulus;
            }else {
              $nama_pt ='-';
              $pt_lulus ='-';
            }
          @endphp
          @if($nama_sd !='-')
            <tr>
              <td width=32%>SD/Sederajat</td>
              <td width=35%>{{$nama_sd }}</td>
              <td width= 10%>{{$sd_lulus }}</td>
            </tr>
          @endif

          @if ($nama_smp!='-')
            <tr>
              <td width=32%>SLTP/Sederajat</td>
              <td width=35%>{{$nama_smp }}</td>
              <td width= 10%>{{$smp_lulus }}</td>
            </tr>
          @endif
         @if ($nama_sma !='-')
          <tr>
            <td width=32%>SLTA/SMK/Sederajat</td>
            <td width=35%>{{$nama_sma }}</td>
            <td width= 10%>{{$sma_lulus }}</td>
          </tr>
         @endif

         @if ($nama_diploma!='-')
         <tr>
          <td width=32%>D-1/D-2/D-3/D-4</td>
          <td width=35%>{{$nama_diploma }}</td>
          <td width= 10%>{{$diploma_lulus }}</td>
        </tr>
         @endif

         @if ($nama_akta!='-')
          <tr>
            <td width=32%>Akta-1/Akta-2/Akta-3/Akta-4</td>
            <td width=35%>{{$nama_akta }}</td>
            <td width= 10%>{{$akta_lulus }}</td>
          </tr>
         @endif

        @if ($nama_pt!='-')
        <tr>
          <td width=32%>S1/S2/S3</td>
          <td width=35%>{{$nama_pt }}</td>
          <td width= 10%>{{$pt_lulus }}</td>
        </tr>
        @endif

        <tr>
          <td  colspan="3"><b>Keterampilan/Pengalaman Kerja</b></td>
        </tr>

        @foreach ($data_pelatihan as $index => $dataItem)
            <tr>
                <td> {{ $dataItem->nama_jenispelatihan}}</td>
                <td> {{ $dataItem->lembaga_pelatihan}}</td>
                <td class="text-center">Thn {{ $dataItem->tahun}}</td>
            </tr>
        @endforeach

        @foreach ($data_pekerjaan as $index => $dataItem)
        <tr>
            <td> {{ $dataItem->jabatan}}</td>
            <td> {{ $dataItem->nama_perusahaan}}</td>
            <td class="text-center">Thn {{ $dataItem->tahun}}</td>
        </tr>
    @endforeach
    </table>
  </body>
</html>
