@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Tipe Riksa Uji" subtitle="Buat tipe riksa uji baru." back="{{ panel_route('riksa-uji-types.index') }}" />
@endsection

@section('content')
    @include('admin.riksa-uji-types._form', ['type' => null])
@endsection
