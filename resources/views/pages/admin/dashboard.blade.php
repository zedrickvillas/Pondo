@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div class="container">
   		<h1>Admin</h1>
        @include('panels.admin.modules')
    </div>

@endsection