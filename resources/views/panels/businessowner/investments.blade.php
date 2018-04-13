<div class="panel panel-default p-1">
                    
                    <div class="panel-heading">
                        <h2>Investments</h2>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Invesment</a>
                    </div>
                    <div class="panel-body">
                        @if(count($data['posts']) > 0)
                            <table class="table table-default">
                                <tr class="active">
                                    <th></th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                    <td style="width: 200px;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach($data['posts'] as $post)

                                    <table class="table table-default">

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
                                        </td>

                                    </tr>

                                @endforeach
                            </table>

                            <div class="text-center">
                                {!! $data['posts']->links() !!}
                            </div>

                        @else
                            <p>You have no posts</p>
                        @endif

                    </div>
</div>

