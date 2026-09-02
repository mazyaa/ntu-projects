@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Halaman" subtitle="Buat halaman statis baru." back="{{ panel_route('pages.index') }}" />
@endsection

@section('content')
    @include('admin.pages._form', ['page' => null])
@endsection
