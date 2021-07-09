@extends('admin.layout')
@section('title', 'Kontak')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item active">Contact</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form Contact</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.contact.update', $model->id) }}" method="post">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email</label>
                            <div class="controls">
                                <input class="form-control" id="email" size="16" type="text" name="email" placeholder="Company email" value="{{ $model->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="phone">Phone</label>
                            <div class="controls">
                                <input class="form-control" id="phone" size="16" type="text" name="phone" placeholder="Company phone" value="{{ $model->phone }}" required>
                                <span class="help-block">Please enter the full phone number in international format, example ('+6283830802189')</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="address">Address</label>
                            <div class="controls">
                                <input class="form-control" id="address" size="16" type="text" name="address" placeholder="Company address" value="{{ $model->address }}" required>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop
