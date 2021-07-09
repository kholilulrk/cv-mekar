@extends('website.layout')

@section('content')

{{-- slider --}}
@include('website.slider.index')
{{-- slider --}}

{{-- why us --}}
@include('website.whyUs.index')
{{-- why us --}}

{{-- about --}}
@include('website.about.index')
{{-- about --}}

{{-- gallery --}}
@include('website.gallery.index')
{{-- gallery --}}

{{-- service --}}
@include('website.service.index')
{{-- service --}}

{{-- Contact --}}
@include('website.contact.index')
{{-- Contact --}}
@endsection
