<div class="panel panel-default p-1">
                    
                    <div class="panel-heading">
                        <h2>Investments</h2>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Invesment</a>
                    </div>
                   
                    <div class="panel-body">
                    
                        @if(count($posts) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr class="investment-table-row">
                                        <td style="width: 200px;">
                                            <a href="{{ $post->image }}" data-lightbox="featured-image">
                                                <div class="table-thumbnail" style="background-image: url({{ $post->image }});"></div>
                                            </a>
                                        </td>
                                        <td>{{$post->id}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->created_at}}</td>
                                        <td>
                                            <a href="{{ route('posts.gallery.index', ['post' => $post]) }}" class="btn btn-default">Gallery</a>
                                            <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>
                                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'style' => 'display: inline-block;'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                            <a href=" {{ route('posts.show', ['post' => $post]) }} " class="btn btn-default">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="text-center">
                                {!! $posts->links() !!}
                            </div>

                        @else
                            <p>You have no posts</p>
                        @endif

                    </div>
</div>

                