@extends('layouts.landing')

@section('title', __('ui.page_titles.home'))

@section('content')
    <x-landing.hero />
    <x-landing.trusted-by />
    <x-landing.about />
    <x-landing.values />
    <x-landing.services />
    <x-landing.workflow />
    <x-landing.statistics />
    <x-landing.experience />
    <x-landing.leadership />
    <x-landing.insights />
    <x-landing.faq />
    <x-landing.cta />
@endsection
