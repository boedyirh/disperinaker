<div>
    <script>
        document.addEventListener('livewire:load', function () {

        var btns =document.querySelectorAll('.get-slot');
        Array.from(btns).forEach(function(btn){
        btn.addEventListener('click',function(e){
            var id = e.currentTarget.getAttribute('data-record');
            console.log(id);
            const hari = e.currentTarget.getAttribute('data-hari');
            var tanggal = e.currentTarget.getAttribute('data-tanggal');
            const waktu = e.currentTarget.getAttribute('data-waktu');
            tanggal = tanggal.split("-").reverse().join("-");
            document.getElementById('slot_id').value=id;
            document.getElementById('hari_id').innerHTML= hari+', '+tanggal;
            document.getElementById('waktu_id').innerHTML= 'Jam : '+waktu;
            @this.set('slot_id', id);
                });
            });
        })



        window.addEventListener('postUpdated', event => {
            $('#myModal').modal('hide');
            })

    </script>

    @if($sudah_ambil_jadwal){



    }
    @else{







    }
    @endif

    <div class="table-responsive">
        <table class="table ">
            <thead class="sticky">
                    <tr>
                        <th class="text-center align-middle abu" colspan="7" ><h4>Pilih Slot Waktu Wawancara</h4></th>
                    </tr>
                    <tr >
                        <th class="text-center align-middle abu"><i class="fa fa-backward "> </th>
                            @foreach ($tanggal_wawancara as $dataItem)
                                <th class="text-center align-middle abu">{{ $dataItem->nama_hari }}  <div>{{$dataItem->day  }}  {{ $dataItem->nama_bulan }}  {{ $dataItem->year }}</div></th>
                            @endforeach
                        <th class="text-center align-middle abu"><i class="fa fa-forward">  </th>
                    </tr>
            </thead>
            <tbody class="scroll" id="daftar">
                {{-- Akan looping sebanyak 37 kali sesuai jumlah slot setiap harinya--}}
                @php
                    $counter=1;
                @endphp
                @foreach ($initial_slot as $dataSlot)
                    <tr>
                        @php
                            // Ambil data tanggal pada minggu ke
                            $dataWaktu = $recordDataWaktu->firstWhere('urutan',$counter);
                            $waktu = $dataWaktu->waktu;
                            // Ambil slot data layanan pada urutan sesuai counter
                            $slot_mingguan =$recordDataSlot->where('urutan',$counter)->all();
                            $counter++;
                        @endphp

                        <td  class="text-center align-middle">{{ $waktu }}</td>
                            {{-- Akan looping sebanyak 5 kali untuk Hari Senin-Jumat --}}
                            {{-- foreach untuk slot mingguan --}}
                            @foreach ($slot_mingguan as $dataItem)


                                @if ($waktu=='Istirahat')
                                    <td class="text-center align-middle hijau">
                                        <button type="button" class="btn btn-block btn-default btn-sm">Istirahat</button>
                                    </td>
                                @else
                                    {{-- Cek jika hari libur --}}
                                    {{-- Cek jika hari telah lewat  --}}
                                    {{-- Hari Jumat istirahatnya mulai jam 11:00-13:00 karena shalat shalat Jumat --}}
                                    {{-- Cek jika slot telah diambil --}}
                                    @if($dataItem->libur_layanan=='t')
                                        <td class="text-center align-middle hijau">
                                            <button type="button"   class="btn btn-block btn-default btn-sm">Istirahat Shalat Jumat</button>
                                            <div class="margin-10px-top font-size14">{{ $waktu }}</div>
                                        </td>
                                    @elseif ($dataItem->sudah_dipesan!='-')
                                        <td class="text-center align-middle ">
                                            {{-- <button type="button"   class="btn btn-block btn-primary btn-sm">Ambil Slot {{ $dataItem->slot_wawancara_id }}</button> --}}
                                            {{-- <a href="#"   class="btn btn-block btn-primary btn-sm get-slot" data-toggle="modal" data-waktu="{{ $dataItem->waktu }}"  data-tanggal="{{ $dataItem->tanggal }}"  data-record="{{ $dataItem->rand_slot_wwc }}"  data-hari="{{ $dataItem->hari }}" data-target=".ambil-slot"> &nbsp;Tidak tersedia</a> --}}
                                            <button type="button"   class="btn btn-block btn-default btn-sm">Tidak tersedia</button>
                                            <div class="margin-10px-top font-size14">{{ $waktu }}</div>
                                        </td>
                                    @else
                                        <td class="text-center align-middle ">
                                            {{-- <button type="button"   class="btn btn-block btn-primary btn-sm">Ambil Slot {{ $dataItem->slot_wawancara_id }}</button> --}}
                                            <a href="#"   class="btn btn-block btn-primary btn-sm get-slot" data-toggle="modal" data-waktu="{{ $dataItem->waktu }}"  data-tanggal="{{ $dataItem->tanggal }}"  data-record="{{ $dataItem->rand_slot_wwc }}"  data-hari="{{ $dataItem->hari }}" data-target=".ambil-slot"> &nbsp;Ambil-Slot</a>
                                            <div class="margin-10px-top font-size14">{{ $waktu }}</div>
                                        </td>

                                    @endif

                                @endif
                            @endforeach

                            <td class="text-center align-middle " >{{ $waktu }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


<!-- Modal untuk pilih slot -->

    <div wire:ignore  class="modal fadeInRight ambil-slot animated" id="myModal" role="dialog" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header birulte"> <button type="button" aria-label="modal_reset_cfg" data-dismiss="modal" class="close" ><span aria-hidden="true">×</span></button>
            <strong class="modal-title" >Anda akan mengambil slot wawancara pada waktu berikut</strong>
            </div> <!-- end of modal-header -->
            {{-- <form action="/pemakai/hapus" name="hapus_record"   autocomplete="off"   method="post" accept-charset="utf-8"> --}}
            <form  wire:submit.prevent="submit"  >
                @csrf
                <div  class="modal-body">
                    <div  wire:ignore >
                        <input  wire:ignore.self wire:model ="slot_id" type="hidden"   id="slot_id" />
                    </div>
                <div class="form-group">
                    <div wire:ignore class="col-md-6">
                        <label   class="control-label   text-center" id="hari_id"> </label>
                    </div>

                    <div wire:ignore class="col-md-6">
                        <label    class="control-label" id="waktu_id"></label>
                    </div>
                </div>
                </div><!-- end of modal-body -->
                </br>
                <div class="modal-footer"  style="border-top:none; align:center">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary" ><i class="fa fa fa-times"></i> Batal</button>
                    <button   type="submit" class="btn btn-success1" ><i class="fa fa fa-check-square-o"></i> Konfirmasi Ambil Slot</button>
                </div><!-- end of modal-footer -->
            </form>
        </div> <!-- end of modal-content -->
        </div> <!-- end of modal-dialog -->
    </div> <!-- end of modal ambil-slot-->


</div>
