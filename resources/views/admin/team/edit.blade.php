@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Anggota Tim" subtitle="Perbarui data anggota tim." back="{{ panel_route('team.index') }}" />
@endsection

@section('content')
    @include('admin.team._form', ['member' => $member])
@endsection
