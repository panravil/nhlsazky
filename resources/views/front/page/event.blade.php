@extends('clean.layouts.app')
@section('page')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page_tittle">O mne</h1>


            <div class="page_wrapper">
                {!! $page->html_template !!}
            </div>

        </div>

    </div>
</div>
@endsection
