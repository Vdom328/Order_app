@extends('admin.layouts.master')
@section('title')
    Edit Emails
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/codemirror/codemirror.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/codemirror/theme.css') }}">
    <style>
        .note-editable {
            height: 300px !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <div class="col-lg-12 page-content-area">
                <div class="inner-content">
                    <form method="post" action="{{ route('admin.emails.postEdit') }}" class="custom-fieldset-style mg-b-30">
                        @csrf
                        <input type="hidden" name="id" value="{{ $email->id }}">
                        <div class="col-12 mt-4">
                            <label for="">Name:</label>
                            <input type="text" name="name" disabled value="{{ $email->name }}" class="form-control">
                        </div>
                        <div class="col-12 mt-4">
                            <label for="">Subject:</label>
                            <input type="text" name="subject" value="{{ $email->subject }}" class="form-control">
                        </div>
                        <div class="col-12 mt-4">
                            <textarea id="form-email" name="body" class="form-control">{{ $email->body }}</textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex justify-content-end">
                            <button class="btn btn-primary waves-effect mb-3">
                                Save Emails
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('assets/plugins/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('assets/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-active.js') }}"></script>
    <script>
        $('#form-email').summernote({
            height: 150,
            codemirror: { // codemirror options
                mode: 'text/html',
                htmlMode: true,
                lineNumbers: true,
                theme: 'monokai'
            }
        });
    </script>
@endsection
