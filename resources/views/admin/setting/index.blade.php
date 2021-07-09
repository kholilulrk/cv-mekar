@extends('admin.layout')
@section('title', 'About')
@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item active">About</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form About</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.setting.update', $model->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="title">Website Title</label>
                            <div class="controls">
                                <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Website Title" value="{{ $model->title }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="author">Website Author</label>
                            <div class="controls">
                                <input class="form-control" id="author" size="16" type="text" name="author" placeholder="Website Author" value="{{ $model->author }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="keyword">Keywords</label>
                            <div class="controls">
                                <input class="form-control" id="keyword" size="16" type="text" name="keyword" placeholder="Website Keywords" value="{{ $model->keyword }}" required>
                                <span class="help-block">You may insert multiple keyword, separated by comma. Example ('fashion,hat,clothes')</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="short_description">Short Description</label>
                            <div class="controls">
                                <textarea class="form-control" id="short_description" name="short_description" cols="30" rows="10" placeholder="Short description about your website">{{ $model->short_description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="editor">Description</label>
                            <div class="controls">
                                <div id="editor"></div>
                                <input type="hidden" name="description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="fb_pixel">Facebook Pixel</label>
                            <div class="controls">
                                <textarea class="form-control" id="fb_pixel" name="fb_pixel" cols="30" rows="10" placeholder="Code from Facebook Pixel">{{ $model->fb_pixel }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="google_analytic">Google Analytic</label>
                            <div class="controls">
                                <textarea class="form-control" id="google_analytic" name="google_analytic" cols="30" rows="10" placeholder="Code from Google Analytic">{{ $model->google_analytic }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="icon">Website Icon</label>
                            <div class="controls">
                                <img class="img-fluid" id="icon" alt="Website Icon" width="100" height="100" src="{{ asset($model->showicon()) }}" />
                                <input type="file" onchange="document.getElementById('icon').src = window.URL.createObjectURL(this.files[0])" name="icon">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="logo">Website Logo</label>
                            <div class="controls">
                                <img class="img-fluid" id="logo" alt="Website Logo" width="100" height="100" src="{{ asset($model->showlogo()) }}" />
                                <input type="file" onchange="document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])" name="logo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="logo_grayscale">Website Logo Grayscale Version</label>
                            <div class="controls">
                                <img class="img-fluid" id="logo_grayscale" alt="Website Logo" width="100" height="100" src="{{ asset($model->showlogograyscale()) }}" />
                                <input type="file" onchange="document.getElementById('logo_grayscale').src = window.URL.createObjectURL(this.files[0])" name="logo_grayscale">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.setting.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop

@section('scripts')
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    @if($model->type == 'video')
    <script type="text/javascript">
        $('#url-image').hide();
        $('#url-video').show();
    </script>
    @else
    <script type="text/javascript">
        $('#url-video').hide();
        $('#url-image').show();
    </script>
    @endif
    <script>
        $("#date").datepicker({
            format: 'yyyy-mm-dd'
        });
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['image', 'clean']                                         // remove formatting button
        ];
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Description of the article',
            theme: 'snow'  // or 'bubble'
        });

        quill.root.innerHTML = '{!! $model->description !!}';

        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Populate hidden form on submit
            var description = document.querySelector('input[name=description]');
            description.value = quill.root.innerHTML;
            return true;
        };

        function pilihType(that){
            var id          = $(that).val();
            if(id == 'video'){
                $('#url-image').hide();
                $('#url-video').show();
            }
            else if(id == 'image'){
                $('#url-video').hide();
                $('#url-image').show();
            }
            else{
                $('#url-image').hide();
                $('#url-video').hide();
            }
        }
    </script>
@stop
