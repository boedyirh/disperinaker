<div class="box box-primary">

    <div class="box-header with-border">
      <h3 class="box-title">Daftar Hari Libur</h3>&nbsp;&nbsp; <button wire:click="refreshPage" class="btn btn-sm btn-primary" title="Refresh"><i class="fa fa-refresh"></i> &nbsp;&nbsp;Refresh</button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Keterangan</th>
                </tr>
                @php
                    $no =0;
                @endphp

                @if (!$daftarLibur->first())
                    <tr><td colspan='3'  style='text-align: center; font-weight: bold'>- Belum ada data -</td></tr>
                @else
                    @foreach ($daftarLibur as $dataItem )
                        <tr>
                            <td class="text-center"> {{ ++$no +(($page-1)*$perpage)  }}</td>
                            <td class="text-center">{{ date("d-m-Y",strtotime($dataItem->start))}}</td>
                            <td> {{ $dataItem->title}}</td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        {{ $daftarLibur->links('pagination-links') }}
    </div>



</div>
