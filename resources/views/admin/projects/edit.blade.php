@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Proyek" subtitle="Perbarui data proyek." back="{{ panel_route('projects.index') }}" />
@endsection

@section('content')
    @include('admin.projects._form', ['project' => $project])
@endsection
