@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div id="admin" class="container">
   		<h1>Admin Dashboard</h1>
        @include('panels.admin.modules')
    </div>

@endsection