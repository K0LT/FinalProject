@extends('layouts.app')

@section('title', 'QiFlow - Perca Peso de Forma Natural e Sustentável')

@section('content')
    @include('components.landing-page.navbar')
    @include('components.landing-page.hero')
    @include('components.landing-page.start-today')
    @include('components.landing-page.about-jm')
    @include('components.landing-page.why-qiflow')
    @include('components.landing-page.plans')
    @include('components.landing-page.testimonials')
    @include('components.landing-page.ready-to-start')
    @include('components.landing-page.footer')
@endsection
