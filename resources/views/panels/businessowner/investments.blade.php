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
                                        <table class="table table-default">
                                    <tr class="info"><span style="font-weight:bold">
                                            <td><span style="font-weight:bold">Title</span></td>
                                            <td><span style="font-weight:bold">Amount</span></td>
                                            <td><span style="font-weight:bold">Investor</span></td>
                                            <td><span style="font-weight:bold">Purchased At</span></td>
                                            <td><span style="font-weight:bold">Status</span></td>
                                            <td></td>
                                        </span>

                                    </tr>
                                        @foreach($data['funds'] as $fund)
                                            <tr>
                                                <td>{{DB::table('posts')->select('title')->where('id',$post->id)->implode('title')}}</td>
                                                <td>{{DB::table('funds')->select('amount')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('amount')}}</td>
                                                <td>{{$fund->investor}}</td>
                                                <td>{{$fund->created_at}}</td>
                                                <td>{{$fund->status}}</td>
                                                <td><button type="button" class="btn btn-microsoft btn-sm">Return Investment</button></td>
                                            </tr>
                                        @endforeach
                                        </table>
                                    </table>

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

                