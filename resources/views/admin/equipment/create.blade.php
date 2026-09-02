@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Pesawat Angkat" subtitle="Buat data pesawat angkat baru." back="{{ panel_route('equipment.index') }}" />
@endsection

@section('content')
    @include('admin.equipment._form', ['item' => null])
@endsection
