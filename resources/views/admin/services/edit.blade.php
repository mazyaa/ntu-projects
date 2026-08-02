@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Layanan" subtitle="{{ $service->title }}" back="{{ panel_route('services.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    @include('admin.services._form', ['service' => $service])
@endsection
