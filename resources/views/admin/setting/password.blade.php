@extends('admin.layout')
@section('title', 'Password')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Ganti Password</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form Ganti Password
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.password.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="old_password">Password Lama</label>
                            <div class="controls input-group">
                                <span class="input-group-prepend">
                                    <button class="btn btn-primary show-password" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </span>
                                <input class="form-control" id="old_password" size="16" type="password" name="old_password" placeholder="********" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password">Password</label>
                            <div class="controls input-group">
                                <span class="input-group-prepend">
                                    <button class="btn btn-primary show-password" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </span>
                                <input class="form-control" id="password" size="16" type="password" name="password" placeholder="********" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">Password Confirmation</label>
                            <div class="controls input-group">
                                <span class="input-group-prepend">
                                    <button class="btn btn-primary show-password" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </span>
                                <input class="form-control" id="password_confirmation" size="16" type="password" name="password_confirmation" placeholder="********" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.password.index') }}" class="btn btn-secondary">Cancel</a>
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
    <script>
        $('.show-password').on('click', function() {
            let input = $(this).parent().next();
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        })
    </script>
@stop