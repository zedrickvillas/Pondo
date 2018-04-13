<div class="panel panel-default p-1">
                    
                    <div class="panel-heading d-flex" style="justify-content: space-between;">
                        <h2 class="no-margin">Your Investments</h2>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Investment <i class="fa fa-plus"></i></a>
                    </div>
                    <div class="panel-body">

                        @if(count($posts) > 0)
                            <table class="table table-default">
                                <tr class="active">
                                    <th>Image</th>
                                    <th>Investment Id</th>
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
                                                <a href=" {{ route('posts.show', ['post' => $post]) }} " class="btn btn-default">View</a>
                                                <a href=" {{ route('posts.transactions', ['post' => $post->id]) }} " class="btn btn-default">Transactions</a>
                                            </td>

                                    </tr>
                                @endforeach

                            </table>

                            <div class="text-center">
                                {!! $posts->links() !!}
                            </div>

                        @else
                            <p>No investment yet.</p>
                        @endif

                    </div>
</div>

