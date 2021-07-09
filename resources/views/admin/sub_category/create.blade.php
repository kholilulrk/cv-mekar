@extends('admin.layout')
@section('title', 'Add Sub Category')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Category</li>
    <li class="breadcrumb-item active">Sub Category</li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.sub_category.create') }}">
                <i class="icon-plus"></i>  Add Sub Category</a>
        </div>
    </li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form Sub Category</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.sub_category.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
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
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" placeholder="Name of the sub category" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="desc">Description</label>
                            <div class="controls">
                                <textarea class="form-control" id="desc" name="description" cols="30" rows="10" placeholder="Description of the sub category" required>{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="img-container">Photo</label>
                            <div class="controls">
                                <img class="img-fluid" id="img-container" alt="Speaker " width="100" height="100" src="{{ asset('static/admin/img/default.png') }}" />
                                <input type="file" onchange="document.getElementById('img-container').src = window.URL.createObjectURL(this.files[0])" name="image" required>
                            </div>
                            <span class="help-block">Maximum allowed size is 2MB</span>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.sub_category.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop
