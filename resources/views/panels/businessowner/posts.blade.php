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
                                    <tr>
                                        <td style="width: 200px;">
                                            <div class="table-thumbnail" style="background-image: url({{ $post->image }});"></div>
                                        </td>
                                        <td>{{$post->id}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->created_at}}</td>
                                        <td>
                                            <a href="{{ route('posts.gallery.index', ['post' => $post]) }}">Gallery</a>
                                            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'style' => 'display: inline-block;'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no posts</p>
                        @endif

                    </div>
</div>

                