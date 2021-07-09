@extends('clean.layouts.app')
@section('page')
    @include('clean.layouts.header')

    @include('clean.home.parts.about')
    @include('clean.home.parts.quickStats')
    @include('clean.home.parts.news')
    @include('clean.home.parts.testimonials')
    @include('clean.home.parts.faq')
@endsection
