@extends('layouts.v_template')
@section('keterangan','Managemen Pengajuan Kartu Pencari Kerja')
@section('title','Proses Kartau AK-1 Hari ini v_ak1_proses_hari_ini.blade.php')
@section('breadcrumb','Proses kartu hari ini')

@push('styles')

    <style>

    </style>
@endpush

@push('scripts')


@endpush
@section('content')
    @livewire('backend.ak1-pengajuan')
@endsection

