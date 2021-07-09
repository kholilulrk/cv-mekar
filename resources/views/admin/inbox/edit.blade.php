@extends('admin.layout')
@section('title', 'Reply Inbox')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Inbox</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Inbox</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.inbox.update', $model->id) }}" method="post">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" value="{{ $model->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="phone">Phone</label>
                            <div class="controls">
                                <input class="form-control" id="phone" size="16" type="text" name="phone" value="{{ $model->phone }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email</label>
                            <div class="controls">
                                <input class="form-control" id="email" size="16" type="email" name="email" value="{{ $model->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="desc">Description</label>
                            <div class="controls">
                                <textarea class="form-control" id="desc" name="description" cols="30" rows="10" readonly>{{ $model->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="respond">Respond</label>
                            <div class="controls">
                                <textarea class="form-control" id="respond" name="respond" cols="30" rows="10" placeholder="What is your respond" required>{{ $model->respond }}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Send Reply</button>
                            <a href="{{ route('admin.inbox.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop