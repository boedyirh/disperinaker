<div>
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
            <tbody class="scroll">
                {{-- Akan looping sebanyak 37 kali sesuai jumlah slot setiap harinya--}}
                @php
                    $counter=1;
                @endphp
                @foreach ($initial_slot as $dataSlot)
                    <tr>
                        @php
                            $dataWaktu = App\Models\InitialSlotModel::getWaktuSlot($counter,'wawancara_ak1');
                            $waktu = $dataWaktu->waktu;
                            $tahun = 2022;
                            $minggu_ke =3;
                            $slot_mingguan = App\Models\SlotWawancaraModel::getSlotMingguan($tahun,$minggu_ke,$counter);
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
                                        <td class="text-center align-middle ">
                                            <button type="button"   class="btn btn-block btn-default btn-sm">Istirahat Shalat Jumat</button>
                                            <div class="margin-10px-top font-size14">{{ $waktu }}</div>
                                        </td>
                                    @else
                                        <td class="text-center align-middle ">
                                            <button type="button"   class="btn btn-block btn-primary btn-sm">Ambil Slot {{ $dataItem->slot_wawancara_id }}</button>
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
</div>
