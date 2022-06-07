<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Tanda tangan Pejabat</h3>
    </div>
    <div class="box-body marginbody">
        @if($nama_penandatangan_edit)
            <div class="marginselect">
                <select name="" class="form-control" wire:model="pejabat_id" wire:change="updatePejabat" >
                    <option value="">Pilih Pejabat</option>
                    @foreach($d_pejabat as $item)
                        <option value="{{ $item['id']}}">{{ $item['nama'] }}</option>
                    @endforeach
                </select>
            </div>

        @else
            <td>
                <span  wire:click="editPejabat()"> Pejabat : {{ $nama_penandatangan }}  </span>
            </td>
        @endif



     </div>

</div>