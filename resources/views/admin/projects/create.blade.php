@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Proyek" subtitle="Buat data proyek baru." back="{{ panel_route('projects.index') }}" />
@endsection

@section('content')
    @include('admin.projects._form', ['project' => null])
@endsection
