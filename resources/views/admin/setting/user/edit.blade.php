@extends('admin.layout')
@section('title', 'Edit User')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
    <li class="breadcrumb-item active">Edit</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form User</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.user.update', $model->id) }}" method="post">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" placeholder="User full name" value="{{ $model->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="username">Username</label>
                            <div class="controls">
                                <input class="form-control" id="username" size="16" type="text" name="username" placeholder="Username for login" value="{{ $model->username }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password">Password</label>
                            <div class="controls">
                                <input class="form-control" id="password" size="16" type="password" name="password" placeholder="********">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">Password Confirmation</label>
                            <div class="controls">
                                <input class="form-control" id="password_confirmation" size="16" type="password" name="password_confirmation" placeholder="********">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop