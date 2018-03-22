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


				<div class="row">
					@foreach($post->images as $image)
						<div class="col-md-4 p-2">
							<div style="width: 100%; 
										height: 130px;
										background-image: url({{ $image->image }});
										background-repeat: no-repeat;
										background-position: center;
										background-size: fill;
										box-shadow: 0px 5px 7px 0px #f3e1e1;
										border-radius: 4px;"></div>
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