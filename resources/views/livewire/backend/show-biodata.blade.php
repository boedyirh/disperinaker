<div>
    <div class="col-md-3 no-l-padding">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Biodata</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <img class="profile-user-img img-responsive" src="{{ url('storage/foto_diri/'.$data_pemohon->foto_diri) }}" width="300" height="200" alt="Foto diri">
              <h3 class="profile-username text-center">
                @if ($nama_edit)
                <div class="col-xs-12">
                   <input type="text" class="form-control" name="nama" wire:model.lazy="nama" wire:keydown.enter="updateNama" maxlength="40">
                </div>
                @else
                  <span wire:click="editNama()">{{ $nama }}</span>
                @endif
              </h3>
              @if($errors->has('pesan_nama_selesaikan'))
                <br><em class="text-danger">
                    {{ $errors->first('pesan_nama_selesaikan') }}
                </em>
              @endif


              <table class="table table-striped">
                <tbody>
                  <tr >
                    <td width=40%>Phone
                      @if($errors->has('pesan_hp_selesaikan'))
                      <br><em class="text-danger">
                          {{ $errors->first('pesan_hp_selesaikan') }}
                      </em>
                    @endif
                    </td>
                    <td width=60%  >
                      @if ($nomer_hp_edit)
                         <input type="text" class="form-control" name="nomer_hp" wire:model.lazy="nomer_hp" wire:keydown.enter="updateNomerHP" maxlength="15">
                      @else
                        <p   wire:click="editNomerHP()" class="text-muted">  {{ substr($nomer_hp, 0, 4) . "-" . substr($nomer_hp, 4, 4) . "-" . substr($nomer_hp, 8,7) }}
                        </p>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td width=40%>Jenis Kelamin
                      @if($errors->has('pesan_jk_selesaikan'))
                      <br><em class="text-danger">
                          {{ $errors->first('pesan_jk_selesaikan') }}
                      </em>
                    @endif
                    </td>
                    <td width=60%>
                      @if ($jeniskelamin_edit)
                        <select name="" class="form-control" wire:model="jeniskelamin_id" wire:change="updateJenisKelamin">
                          <option value="">Jenis Kelamin</option>
                          <option value="1">Laki-laki</option>
                          <option value="2">Perempuan</option>
                        </select>
                      @else
                        <span wire:click="editJenisKelamin()">{{ $nama_jeniskelamin }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td width=40%>Status Kawin
                      @if($errors->has('pesan_kawin_selesaikan'))
                      <br><em class="text-danger">
                          {{ $errors->first('pesan_kawin_selesaikan') }}
                      </em>
                    @endif
                    </td>
                    <td width=60%>
                      @if ($kawin_edit)
                      <select name="" class="form-control" wire:model="kawin_id" wire:change="updateKawin">
                        <option value="">Status Kawin</option>
                        <option value="1">Kawin</option>
                        <option value="2">Tidak Kawin</option>
                      </select>
                    @else
                        <span wire:click="editKawin()">{{ $nama_kawin }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Tempat Lahir
                      @if($errors->has('pesan_tpt_selesaikan'))
                      <br><em class="text-danger">
                          {{ $errors->first('pesan_tpt_selesaikan') }}
                      </em>
                    @endif
                    </td>
                    <td>

                      @if ($tempat_lahir_edit)
                      <input type="text" class="form-control"     name="tempat_lahir" wire:model.lazy="tempat_lahir" wire:keydown.enter="updateTempatLahir">
                    @else
                      <span wire:click="editTempatLahir()"  > {{ $tempat_lahir  }}
                      </span>
                    @endif

                    </td>
                  </tr>
                    <tr>
                      <td>Tgl Lahir
                        @if($errors->has('pesan_tgl_selesaikan'))
                        <br><em class="text-danger">
                            {{ $errors->first('pesan_tgl_selesaikan') }}
                        </em>
                      @endif
                      </td>
                      <td>
                        @if ($tgl_lahir_edit)
                        <input wire:model.lazy="tgl_lahir" type="text" name="tgl_lahir" id="tgl_lahir" class="form-control"/>
                        @else
                          <span wire:click="editTglLahir()"  > {{ date("d-m-Y",strtotime($tgl_lahir))}} </span>
                          <input wire:model.lazy="tgl_lahir" type="text" name="tgl_lahir" id="tgl_lahir" class="form-control hidden"/>
                        @endif
                      </td>
                    </tr>
                  <tr>
                    <td>Agama
                      @if($errors->has('pesan_agama_selesaikan'))
                        <br><em class="text-danger">
                            {{ $errors->first('pesan_agama_selesaikan') }}
                        </em>
                      @endif
                    </td>
                    <td>
                      @if ($agama_edit)
                          <select name="" class="form-control" wire:model="agama_id" wire:change="updateAgama">
                            <option value="">Pilih Agama</option>
                            <option value="1">Islam</option>
                            <option value="2">Katolik</option>
                            <option value="3">Protestan</option>
                            <option value="4">Hindu</option>
                            <option value="5">Budha</option>
                            <option value="6">Konghucu</option>
                            <option value="7">Lain-lain</option>
                          </select>
                      @else
                          <span wire:click="editAgama()">{{ $nama_agama }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr class="warna">
                    <td>Jadwal Ambil</td>
                    <td>{{ date("d-m-Y",strtotime($data_pemohon->tanggal_jadwal))}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="text-center" >
                <a href="/generate-pdf/{{ $rand_ak1 }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary button-rapi"> Cetak Kartu </a>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

</div>
