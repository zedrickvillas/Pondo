<div class="panel panel-default p-1">
                    
                    <div class="panel-heading">
                        <h2>Investments</h2>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Invesment</a>
                    </div>
    {!! Form::open(['action' => 'UserController@store', 'method' => 'POST']) !!}
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
                                            <td><span style="font-weight:bold">Quantity</span></td>
                                            <td><span style="font-weight:bold">Title</span></td>
                                            <td><span style="font-weight:bold">Amount</span></td>
                                            <td><span style="font-weight:bold">Investor</span></td>
                                            <td><span style="font-weight:bold">Purchased At</span></td>
                                            <td><span style="font-weight:bold">Status</span></td>
                                            <td><span style="font-weight:bold">Return Date</span></td>
                                            <td>{{Form::submit('Return Investment', ['class'=>'btn btn-microsoft btn-sm'])}}</td>
                                        </span>



                                    </tr>
                                        @foreach($data['funds']->unique('investor') as $fund)
                                            @if (empty(DB::table('funds')->select('investor')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('investor')))

                                            @else
                                                    {{--@foreach($data['funds'] as $fund)--}}
                                                    <tr>
                                                        <td>{{DB::table('funds')->select('investor')->where(['Status'=>'Sold','investor'=>$fund->investor])->get()->count()}}</td>
                                                        <td>{{DB::table('posts')->select('title')->where('id',$post->id)->implode('title')}}</td>
                                                        <td>{{DB::table('funds')->select('amount')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('amount')}}</td>
                                                        <td>{{DB::table('funds')->select('investor')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('investor')}}</td>
                                                        <td>{{DB::table('funds')->select('created_at')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('created_at')}}</td>
                                                        <td>{{DB::table('funds')->select('status')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('status')}}</td>
                                                        <th>{{DB::table('funds')->select('return_date')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('return_date')}}</th>
                                                        {{ Form::hidden('post_id', $post->id)}}
                                                        @if (DB::table('funds')->select('status')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('status') == 'Sold')
                                                            <td></td>


                                                            {!! Form::close() !!}
                                                            {{--<td><button type="button" class="btn btn-microsoft btn-sm">Return Investment</button></td>--}}
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    {{--@endforeach--}}
                                                    <div class="text-center">
                                                        {!! $data['funds']->links() !!}
                                                    </div>
                                            @endif
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

