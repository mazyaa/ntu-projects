@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Buat Artikel" subtitle="Tulis artikel baru." back="{{ panel_route('articles.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    @php $article = null; @endphp

    <form method="POST" action="{{ panel_route('articles.store') }}">
        @csrf
        @include('admin.articles._form', ['article' => $article])
    </form>
@endsection
