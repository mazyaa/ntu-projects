@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Layanan" subtitle="Buat pilar layanan baru." back="{{ panel_route('services.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    @php $service = null; @endphp
    @include('admin.services._form', ['service' => $service])
@endsection
