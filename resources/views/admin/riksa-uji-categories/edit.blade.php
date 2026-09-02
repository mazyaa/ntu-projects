@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Kategori Riksa Uji" subtitle="Perbarui data kategori riksa uji." back="{{ panel_route('riksa-uji-categories.index') }}" />
@endsection

@section('content')
    @include('admin.riksa-uji-categories._form', ['category' => $category])
@endsection
