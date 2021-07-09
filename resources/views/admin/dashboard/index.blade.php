@extends('admin.layout')
@section('title', 'Dashboard')
@section('breadcrumb')
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item"><a href="#">Admin</a></li>
<li class="breadcrumb-item active">Dashboard</li>
@stop
@section('content')
	<div class="row">
        <div class="col-lg-12">
        	<h2>Selamat Datang, {{@Auth::guard('admin')->user()->name}}</h2>
        </div>
    </div>
@stop
