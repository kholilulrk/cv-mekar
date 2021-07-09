@extends('admin.layout')
@section('title', 'Service')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">whyus</li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.whyus.create') }}">
                <i class="icon-plus"></i>  Add whyus</a>
        </div>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Data whyus
                    <a href="{{ route('admin.whyus.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add whyus</a>
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <table class="table table-responsive-sm table-striped table-vertical-align">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th style="width: 110px;">Preview</th>
                            <th>Information</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($whyus as $key => $model)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <div class="thumbnail">
                                        <img class="img-thumbnail" src="{{ asset($model->showImage()) }}" alt="">
                                    </div>
                                </td>
                                <td>
                                    <b>{{ $model->title }}</b> <br>
                                    <span>{!! $model->description !!}</span> <br>
                                    <span class="text-muted">Publish : {{ $model->created_at }}</span>

                                </td>
                                <td>
                                    <!-- /btn-group-->
                                    <div class="btn-group">
                                        <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('admin.whyus.edit', $model->id) }}">Edit</a>
                                            <form action="{{ route('admin.whyus.destroy', $model->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="dropdown-item" onclick="return confirm('Yakin Data akan dihapus ?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /btn-group-->
                                </td>
                            </tr>
                        @endforeach
                        @if ($whyus->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center"> <b>Table Was Empty</b> </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $whyus->links() }}
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@stop