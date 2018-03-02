@extends('layouts.app')

@section('template_title')
    {{ $business->user->name }}'s' Business
@endsection

@section('template_linked_css')
	<link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
@endsection

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>{{$business->name}}</h2>
			 <form action="{{ route('rate.business') }}" method="POST">

                        {{ csrf_field() }}

                      <div class="rating">

                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $business->averageRating }}" data-size="xs">

                                        <input type="hidden" name="business_id" required="" value="{{ $business->id }}">

                                        <br/>
                                        
                                        @if (Auth::User())

                                        	@if ( !$business->isRatedBy(Auth::User()->id) )
                                        		<button class="btn btn-success">Submit Rate</button>
                                        	@endif

                                        @endif
                                        

                        </div>

                </form>
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

@section('footer_scripts')
	<script src="{{ asset('js/rating/star-rating.min.js') }}"></script>
@endsection