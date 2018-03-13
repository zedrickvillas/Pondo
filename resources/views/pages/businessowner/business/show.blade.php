@extends('layouts.app')

@section('template_title')
    {{ $business->user->name }}'s' Business
@endsection


@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>{{$business->name}}</h2>
		</div>
		<div class="panel-body">
			<form>
				<div class="form-group">
					<label class="form-label">Owner: </label>
			    	<input type="text" class="form-control" value="{{$business->user->name}}" readonly>
				</div>
				<div class="form-group">
					<label class="form-label">Nature: </label>
			    	<input type="text" class="form-control" value="{{$business->nature}}" readonly>
				</div>
				<div class="form-group">
					<label class="form-label">Address: </label>
					<textarea class="form-control" readonly>{{$business->address}}</textarea>
				</div>
			</form>
		</div>
	</div>
    
@endsection
 

@section('template_linked_css')
	<style>
		.panel {
			max-width: 800px;
			margin: auto;
		}

		.panel textarea, .panel input {
			width: 100%;
		}
		.panel textarea {
			resize: vertical;
			height: 200px;
			max-height: 300px;
		}
	</style>
@endsection