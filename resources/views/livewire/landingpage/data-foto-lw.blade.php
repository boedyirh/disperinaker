<div class="flex items-center justify-center text-gray-500 bg-blue-800 h-screen">
    <script>




        function imageData1() {
            return {
                previewUrl: "",
                updatePreview1() {
                var reader,
                    files = document.getElementById("thumbnail1").files;

                reader = new FileReader();

                reader.onload = e => {
                    this.previewUrl = e.target.result;
                };

                reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                document.getElementById("thumbnail1").value = null;
                this.previewUrl = "";
                }
            };
        }

        function imageData2() {
            return {
                previewUrl: "",
                updatePreview2() {
                var reader,
                    files = document.getElementById("thumbnail2").files;

                reader = new FileReader();

                reader.onload = e => {
                    this.previewUrl = e.target.result;
                };

                reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                document.getElementById("thumbnail2").value = null;
                this.previewUrl = "";
                }
            };
        }
    </script>

        @php
            //Untuk mengecek apakah status sebelum atau sesudah upload foto
            //false = fase awal sebelum upload foto
            //true = fase setelah upload foto
            $cek_foto = App\Models\Ak1Model::cekFoto($rand_ak1);


        @endphp
        @if (session()->has('uploadexist'))
            <script>
                 window.setTimeout(function () {
                    $(".alert")
                        .fadeTo(600, 0)
                        .slideUp(600, function () {
                            $(this).hide();
                        });
                }, 1000);
            </script>
            <div class="alert alert-success alert-dismissible"  >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Pesan</h4>
                Foto berhasil diupload
            </div>
        @endif


    <form  wire:submit.prevent="submitFoto" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-sm-6">
                <div class="w-full">
                    <div class="w-full max-w-2xl p-8 mx-auto bg-white rounded-lg">
                        <div class="" x-data="imageData1()">
                            <div x-show="previewUrl == ''">
                                <p class="text-center uppercase text-bold">
                                    <label for="thumbnail" class="cursor-pointer">
                                        Upload Foto KTP
                                    </label>
                                </p>
                            </div>
                            <div  class="imagecontainer"  x-show="previewUrl !== ''" >
                                @if($cek_foto)
                                    <img src="{{ url('storage/foto_ktp/'.$daftar_foto[0]->foto_ktp) }}" width="300" height="200" class="border" alt="Logo">
                                @else
                                <img :src="previewUrl" alt="" class="rounded" width="300" height="200">
                                @endif

                                <div class="row inputcenter">
                                    <br>
                                    @if ($cek_foto)
                                        <input  type="hidden" name="thumbnail1" id="thumbnail1"      wire:model.defer="foto_ktp"  style="width: 300px;" @change="updatePreview1()">
                                    @else
                                        <input type="file" name="thumbnail1" id="thumbnail1"      wire:model.defer="foto_ktp"  style="width: 300px;" @change="updatePreview1()">
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="w-full">
                    <div class="w-full max-w-2xl p-8 mx-auto bg-white rounded-lg">
                        <div class="" x-data="imageData2()">
                            <div x-show="previewUrl == ''">
                                <p class="text-center uppercase text-bold">
                                    <label for="thumbnail" class="cursor-pointer">
                                        Upload Foto 3x4
                                    </label>
                                </p>
                            </div>
                            <div  class="imagecontainer" x-show="previewUrl !== ''" >
                                @if($cek_foto)
                                    <img src="{{ url('storage/foto_diri/'.$daftar_foto[0]->foto_diri) }}" width="165" height="300" class="border" alt="Logo">
                                @else
                                    <img :src="previewUrl" alt="" class="rounded" width="165" height="300">
                                @endif
                                <div  class="row inputcenter">
                                    <br>
                                    @if ($cek_foto)
                                        <input  type="hidden" name="thumbnail2" id="thumbnail2"       wire:model.defer="foto_diri"  style="width: 300px;" @change="updatePreview2()">
                                    @else
                                        <input type="file" name="thumbnail2" id="thumbnail2"       wire:model.defer="foto_diri"  style="width: 300px;" @change="updatePreview2()">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <p></p>
        <div class="row">
            <div class="col-md-12 text-center">
                @if ($cek_foto)

                   {{-- <button wire:click="gantiFoto"  class="btn btn-sm tambah-button">Ganti Foto</button> --}}
                    {{-- <p class="help-block ">Klik tombol Ganti Foto, jika ada kesalahan. Klik tombol berikutnya jika sudah benar.</p> --}}
                @else
                    <input type="hidden" name="posisi" value="uploadfoto">
                    <input type="submit" class="btn-sm tambah-button" name="action" value="Upload Foto">
                    <p class="help-block ">Klik tombol upload sebelum melanjutkan ke berikutnya.</p>
                @endif

            </div>
        </div>
    </form>
</div>
