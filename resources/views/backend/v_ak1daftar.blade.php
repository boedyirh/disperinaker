@extends('layouts.v_template')
@section('keterangan','Managemen Pengajuan Kartu Pencari Kerja')
@section('title','Pengajuan Kartu Pencari Kerja (AK-1) v_ak1daftar.blade.php')
@section('breadcrumb','Pengajuan Kartu Pencari Kerja (AK-1)')

@push('styles')

    <style>

    </style>
@endpush

@push('scripts')


@endpush
@section('content')
    @livewire('backend.ak1-pengajuan')
@endsection

