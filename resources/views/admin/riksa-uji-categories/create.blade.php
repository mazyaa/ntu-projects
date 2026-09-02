@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Kategori Riksa Uji" subtitle="Buat kategori riksa uji baru." back="{{ panel_route('riksa-uji-categories.index') }}" />
@endsection

@section('content')
    @include('admin.riksa-uji-categories._form', ['category' => null])
@endsection
