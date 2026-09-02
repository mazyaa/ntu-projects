@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Anggota Tim" subtitle="Buat data anggota tim baru." back="{{ panel_route('team.index') }}" />
@endsection

@section('content')
    @include('admin.team._form', ['member' => null])
@endsection
