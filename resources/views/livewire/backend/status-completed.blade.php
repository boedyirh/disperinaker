<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Status Pengajuan</h3>
    </div>
    <div class="box-body marginbody">
        <div class="marginselect">


            @if($status_completed_edit)
                <div class="marginselect">
                    <select name="" class="form-control" wire:model="completed" wire:change="updateCompleted"  >
                            <option value="">Belum diverifikasi</option>
                            <option value="0">Belum Komplit</option>
                            <option value="1">Komplit</option>

                    </select>
                </div>

            @else
                <td>
                    <span  wire:click="editCompleted()"> Status : {!! labelComplete($completed) !!}  </span>
                </td>
            @endif









        </div>

     </div>
     <div class="box-footer text-center">
        <a href="/admin/daftar" class="btn   btn-warning">Kembali</a>
        {{-- <a href="/admin/setStatus" class="btn   btn-primary">Set Status</a> --}}
     </div>
</div>