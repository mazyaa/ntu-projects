@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Tipe Riksa Uji" subtitle="Perbarui data tipe riksa uji." back="{{ panel_route('riksa-uji-types.index') }}" />
@endsection

@section('content')
    @include('admin.riksa-uji-types._form', ['type' => $type])
@endsection
