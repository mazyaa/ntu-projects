@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Pesawat Angkat" subtitle="Perbarui data pesawat angkat." back="{{ panel_route('equipment.index') }}" />
@endsection

@section('content')
    @include('admin.equipment._form', ['item' => $item])
@endsection
