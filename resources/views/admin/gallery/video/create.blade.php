@extends('admin.layout')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Gallery</li>
    <li class="breadcrumb-item active">Video</li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.gallery_video.create') }}">
                <i class="icon-plus"></i>  Add Video</a>
        </div>
    </li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form Gallery Video</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.gallery_video.store') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="video">
                        <div class="form-group">
                            <label class="col-form-label" for="title">Title</label>
                            <div class="controls">
                                <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title of the image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="category">Category</label>
                            <div class="controls">
                                <select class="form-control" id="category" name="category_article_id" required>
                                    <option value="null">Please select the category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="desc">Description</label>
                            <div class="controls">
                                <textarea class="form-control" id="desc" name="description" cols="30" rows="10" placeholder="Description of the image"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="url">Url Video</label>
                            <div class="controls">
                                <input class="form-control" id="url" size="16" type="text" name="url" placeholder="Url of the video from youtube">
                                <span class="help-block">Please enter the full url, example ('https://www.youtube.com/watch?v=YbJOTdZBX1g')</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.gallery_video.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop