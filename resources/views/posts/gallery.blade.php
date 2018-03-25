@extends('layouts.app')





@section('content')
	
	
	 <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Gallery</h1>
        </div>
        <div class="panel-body">

            <div class="col-md-8">
            	<form action="{{ route('posts.gallery.upload') }}" class="dropzone" id="addImages">
					{{ csrf_field() }}
					<input type="hidden" name="post_id" value="{{ $post->id }}">
				</form>


				<div class="row" id="gallery-images">
					@foreach($post->images as $image)
						<div class="col-sm-4 p-2">
							<a href="{{ $image->image }}" data-lightbox="investment">
                                <div class="g-image"  style="background-image: url({{ $image->image }});"></div>
                            </a>
						</div>
					@endforeach
				</div>

                    
         
            </div>
            <div class="col-md-4">

              

                <div class="well">

                	<div class="form-group">
                        <label class="form-label">Investment Title:</label>
                        <div class="form-control" disabled>{{ $post->title }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Created At:</label>
                        <div class="form-control" disabled>{{ date('M j, Y h:ia', strtotime( $post->created_at )) }}</div>
                    </div>                        

                    
                    <hr>
                    <div class="d-flex" style="justify-content: space-between;">
                        <input type="button" value="Go back" class="btn btn-danger" onclick="window.history.back()" /> 
                    </div>
                   
                </div>
            </div>

        </div>
    </div>


@endsection