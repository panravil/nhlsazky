@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                  <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
                <i class="fas fa-bars"></i> Menu
            </h6>
            <div class="card-body p-0">
                <div class="list-group-flush">

                    <a href="{{ route('admin.zpravy.index') }}" class="list-group-item list-group-item-action {{ $request->segment(2) == 'zpravy' && !$request->has('unread') ? 'active' : '' }}"><i class="fas fa-envelope-open-text"></i> Vše</a>
<a href="{{ route('admin.zpravy.index', ['unread' => 1]) }}" class="list-group-item list-group-item-action {{ $request->segment(2) == 'zpravy' && $request->has('unread') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Nepřečtené </a>

                    <a class="list-group-item disabled list-group-item-action {{ $request->segment(2) == 'zpravy' && $request->segment(3) == 'create' ? 'active' : '' }}"><i class="fas fa-paper-plane"></i> Odeslat</a>

                    <a href="{{ route('admin.emails.index') }}" class="list-group-item list-group-item-action {{ $request->segment(2) == 'emails' ? 'active' : '' }}"><i class="fas fa-file"></i> Šablony</a>

                </div>
              </div>
          </div>
            </div>
        <div class="col-12 col-md-7 col-lg-8 col-xl-9">
            @yield('subpage')
          </div>
    </div>

@endsection

@section('javascripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.3.1/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: 'textarea.text',
            language: 'en',
            language_url: 'node_modules/tinymce/langs/',
            plugins: "preview ,link,lists,advlist, emoticons, quickbars , code,image,table,autolink,fullscreen,nonbreaking",
            toolbar: "undo redo | styleselect | fontsizeselect fontselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent nonbreaking | image link emoticons | fullscreen",
            content_css: ['//fonts.googleapis.com/css2?family=Teko', '//fonts.googleapis.com/css2?family=Montserrat'],
            font_formats: "Arial=arial,helvetica,sans-serif;" +
                " Arial Black=arial black,avant garde;" +
                " Teko=Teko; Montserrat=Montserrat;" +
                " Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier;" +
                " Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol;" +
                " Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco;" +
                " Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva;" +
                " Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            relative_urls: false,
            remove_script_host: false,
            height: 300
        });
    </script>
@endsection
