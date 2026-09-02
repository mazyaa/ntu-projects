@extends('layouts.landing')

@section('title', __('ui.page_titles.home'))

@section('content')
    <x-landing.hero />
    <x-landing.about />
    <x-landing.why-choose-us />
    <x-landing.workflow />
    <x-landing.industries />
    <x-landing.cta />
@endsection
