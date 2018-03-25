@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            	<h1>Dashboard</h1>

                @include('panels.businessowner.investments')


            </div>
        </div>
    

@endsection

@section('footer_scripts')
@endsection