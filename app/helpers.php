<?php

function labelPengajuan($id)
{
if  ($id=='1')  //Status Awal - Status Pengajuan
   { $StatusLabel = "<span class='label label-danger lb-sm'>Pengajuan</span>"; }
else if ($id=='2')
   { $StatusLabel = "<span class='label label-success lb-sm'>Belum diambil</span>"; }
else if ($id=='3')
   { $StatusLabel = "<span class='label label-primary lb-sm'>Selesai</span>"; }
else   //Status Lain
   { $StatusLabel = "<span class='label label-warning lb-sm'>Lain</span>"; }
  return $StatusLabel;
}

function labelComplete($id)
{
if  ($id=='1')  //Status Awal - Status Pengajuan
   { $StatusLabel = "<span class='label label-success lb-sm'>Komplit</span>"; }
else if ($id=='0')
   { $StatusLabel = "<span class='label label-danger lb-sm'>Belum Komplit</span>"; }
else   //Status Lain
   { $StatusLabel = "<span class='label label-primary lb-sm'>Belum diverifikasi</span>"; }
  return $StatusLabel;
}


function toggle10($cek)
{
   if($cek==1){
      return 0;
  }
  else{
      return 1;
  }
}


function getMingguKe($tanggal)
{
   if(\App\Models\TimeDimensionModel::select('minggu_ke')->where(['db_date'=>$tanggal])
      ->first()){
         $minggu_ke = \App\Models\TimeDimensionModel::select('minggu_ke')->where(['db_date'=>$tanggal])
         ->first();
         return $minggu_ke->minggu_ke;
      } else {
         return null;
      }

}



function getNamaHari($tanggal)
{
   if(\App\Models\TimeDimensionModel::select('nama_hari')->where(['db_date'=>$tanggal])
      ->first()){
         $hari = \App\Models\TimeDimensionModel::select('nama_hari')->where(['db_date'=>$tanggal])
         ->first();
         return $hari->nama_hari;
      } else {
         return null;
      }

}
function ganjil($number){
   if($number % 2 == 0){
       return false;
   }
   else{
       return true;
   }
}

function getStatus_from_id($status_id){
   if(\App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'status_kartu'])
   ->where(['value_dropdown'=>$status_id])
   ->first())
      {
         $jkel = \App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'status_kartu'])
         ->where(['value_dropdown'=>$status_id])
         ->first();
         return $jkel->label_dropdown;
      }else {
         return null;
      }
   }


function getNamaJenisKelamin_from_id($jeniskelamin_id){
      if(\App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'jenis_kelamin'])
      ->where(['value_dropdown'=>$jeniskelamin_id])
      ->first())
         {
            $jkel = \App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'jenis_kelamin'])
            ->where(['value_dropdown'=>$jeniskelamin_id])
            ->first();
            return $jkel->label_dropdown;
         }else {
            return null;
         }
      }

   function getStatusKawin_from_id($kawin_id){
      if(\App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'status_kawin'])
      ->where(['value_dropdown'=>$kawin_id])
      ->first())
      {
         $status = \App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'status_kawin'])
         ->where(['value_dropdown'=>$kawin_id])
         ->first();
         return $status->label_dropdown;
      }

}


function getLabelAgama_from_id($agama_id){
   if(\App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'agama'])
   ->where(['value_dropdown'=>$agama_id])
   ->first())
   {
      $status = \App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'agama'])
      ->where(['value_dropdown'=>$agama_id])
      ->first();
      return $status->label_dropdown;
   }else {
      return null;
   }
}

function getStrataPendidikan_from_id($strata_id){
   if(\App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'tingkat_pendidikan'])
   ->where(['value_dropdown'=>$strata_id])
   ->first())
   {
      $status = \App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'tingkat_pendidikan'])
      ->where(['value_dropdown'=>$strata_id])
      ->first();
      return $status->label_dropdown;
   }else {
      return null;
   }
}

function getJenisPelatihan_from_id($pelatihan_id){
   if(\App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'jenis_pelatihan'])
   ->where(['value_dropdown'=>$pelatihan_id])
   ->first())
   {
      $status = \App\Models\DropdownModel::select('value_dropdown','label_dropdown')->where(['dropdown_type'=>'jenis_pelatihan'])
      ->where(['value_dropdown'=>$pelatihan_id])
      ->first();
      return $status->label_dropdown;
   }else {
      return null;
   }
}


   function getNamaKecamatan_from_id($kecamatan_id){
      if(\App\Models\KecamatanModel::select('kecamatan_id','nama_kecamatan')
      ->where(['kecamatan_id'=>$kecamatan_id])
      ->first())
      {
         $datakecamatan = \App\Models\KecamatanModel::select('kecamatan_id','nama_kecamatan')
         ->where(['kecamatan_id'=>$kecamatan_id])
         ->first();
         return $datakecamatan->nama_kecamatan;
      }else {
         return null;
      }
   }

   function getNamaKeldesa_from_id($keldesa_id){
      if(\App\Models\KeldesaModel::select('id_keldesa_gabungan','nama_keldesa')
      ->where(['id_keldesa_gabungan'=>$keldesa_id])
      ->first())
      {
         $datakeldesa = \App\Models\KeldesaModel::select('id_keldesa_gabungan','nama_keldesa')
         ->where(['id_keldesa_gabungan'=>$keldesa_id])
         ->first();
         return $datakeldesa->nama_keldesa;
      }else {
         return null;
      }
   }


