@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Artikel" subtitle="{{ $article->title }}" back="{{ panel_route('articles.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    <form method="POST" action="{{ panel_route('articles.update', $article) }}">
        @csrf
        @method('PUT')
        @include('admin.articles._form', ['article' => $article])
    </form>
@endsection
