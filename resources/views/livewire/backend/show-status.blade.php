<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Pengajuan</h3>
    </div>
    <div class="box-body marginbody">
        @if($status_edit)
            <div class="marginselect">
                <select name="" id="" wire:model.defer="status_id">
                    <option value="0">Pilih Status</option>
                    <option value="1">Pengajuan</option>
                    <option value="2">Belum diambil</option>
                    <option value="3">Selesai</option>
                </select>
            </div>

            <div>
                <textarea   wire:model.defer="keterangan" class="form-control" cols="40" rows="3"></textarea>
            </div>
        @else
            <td>
                <span wire:click="editStatus()" ><h4 style="margin-top:0px;">Status : {!! labelPengajuan($data_pemohon['status_id']) !!}</h4></span>
            </td>
            <div>
                <textarea  readonly wire:click="editStatus()" class="form-control" cols="40" rows="3">{{ $data_pemohon['keterangan'] }}</textarea>
            </div>

        @endif



     </div>
     <div class="box-footer">
        <a href="/admin/daftar" class="btn   btn-warning">Batal</a>
         <button class="btn btn-primary" wire:click="simpanStatus()">Simpan</button>
     </div>
</div>