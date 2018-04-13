@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')

        <div class="row">
           	<h1>Business Owner Dashboard</h1>

            @include('panels.businessowner.investments')

        </div>
    

@endsection

@section('footer_scripts')
@endsection