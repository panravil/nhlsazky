@extends('clean.layouts.app')
@section('title')
{{ $page->title }} | NHL Sázení
@endsection
@section('page')
<div class="container">
    <div class="row">
        <div class="col-md-12 content"  >
            <h1 class="page_tittle">{{ $page->title }}</h1>


            <div class="page_wrapper">
                {!! $page->html_template !!}
            </div>

        </div>

    </div>
</div>
@endsection
