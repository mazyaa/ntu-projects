@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Halaman" subtitle="Perbarui konten halaman statis." back="{{ panel_route('pages.index') }}" />
@endsection

@section('content')
    @include('admin.pages._form', ['page' => $page])
@endsection
