<div class="panel panel-default p-1">

                    <div class="panel-heading">
                        <h2>Transactions <i class="fa fa-money" aria-hidden="true"></i></h2>
                    </div>

                    <div class="panel-body">

                               <table class="table table-default">
                                <tr class="active">
                                    <th>Image</th>
                                    <th>Investment Id</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                     
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
                     

                            </table>


                               <table class="table table-default">

                                <tr class="info"><span style="font-weight:bold">
                                    <td><span style="font-weight:bold">Title</span></td>
                                    <td><span style="font-weight:bold">Amount</span></td>
                                    <td><span style="font-weight:bold">Investor Id</span></td>
                                    <td><span style="font-weight:bold">Purchased At</span></td>
                                    <td><span style="font-weight:bold">Status</span></td>     
                                    <td><span style="font-weight:bold">Actions</span></td>
                                </tr>

        
                                        @foreach($funds as $fund)
                                            @if (DB::table('funds')->select('investor')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('investor'))
                                                    <tr>
                                                        <td>{{DB::table('posts')->select('title')->where('id',$post->id)->implode('title')}}</td>
                                                        <td>{{DB::table('funds')->select('amount')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('amount')}}</td>
                                                        <td>{{DB::table('funds')->select('investor')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('investor')}}</td>
                                                        <td>{{DB::table('funds')->select('created_at')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('created_at')}}</td>
                                                        <td>{{DB::table('funds')->select('status')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('status')}}</td>
                                                        @if (DB::table('funds')->select('status')->where(['id'=>$fund->id,'post_id'=>$post->id])->implode('status') == 'Sold')
                                                            <td><a href="{{ route('posts.return_investment', ['post' => $post]) }}" type="button" class="btn btn-microsoft btn-sm">Return Investment</a></td>
                                                        @else
                                  
                                                        @endif
                                                    </tr>
                                                
                                            @endif
                                        @endforeach

                                       

                                
                            </table>

                            <div class="text-center">
                                {{ $funds->links() }}
                            </div>

                          
                    </div>
</div>

