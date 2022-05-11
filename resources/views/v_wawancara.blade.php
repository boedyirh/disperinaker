@extends('layouts.v_template')
@section('title','Pembuatan Slot Wawancara Kerja setahun v_wawancara.blade.php')
@section('keterangan','Managemen Wawancara')
@section('breadcrumb','Menu 1A')
@push('styles')
    <style>
    </style>
@endpush

@push('scripts')
@endpush

@section('content')
    <div class="col-md-12">
        <div class="row">
            @livewire('ak1-wawancara')

        </div>
    </div>
@endsection

