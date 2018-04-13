<div class="panel panel-default p-1">

    <div class="panel-heading">
        <h2>Investments</h2>
    </div>



    <div class="panel-body">

        <div class="container" style="width: inherit;">
            {{--To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p>--}}

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">All</a></li>
                <li><a data-toggle="tab" href="#menu1">Sold</a></li>
                <li><a data-toggle="tab" href="#menu2">Completed</a></li>
                <li><a data-toggle="tab" href="#menu3">Failed</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">



                    <h3>All</h3>
                    @if(count($funds) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Investment Title</th>
                                <th>Business Name</th>
                                <th>Amount</th>
                                <th>Return Date</th>
                                {{--<th>Status</th>--}}
                                <th>Created at</th>
                            </tr>
                            @foreach($funds as $fund)
                                <tr class="investment-table-row">
                                    <td></td>
                                    <td>{{$fund->id}}</td>
                                    <td>{{DB::table('posts')->select('title')->where('id',$fund->post_id)->implode('title')}}</td>
                                    <td>{{DB::table('businesses')->select('name')->where('user_id',$fund->business_owner)->implode('name')}}</td>
                                    <td>{{$fund->amount}}</td>
                                    <td>{{$fund->return_date}}</td>
                                    {{--<td>{{$fund->status}}</td>--}}
                                    <td>{{$fund->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="text-center">
                            {{ $funds->links() }}
                        </div>

                    @else
                        <p>You have no investments</p>
                    @endif

                </div>
                <div id="menu1" class="tab-pane fade">



                    <h3>Sold</h3>
                    @if(count($sold) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Investment Title</th>
                                <th>Business Name</th>
                                <th>Amount</th>
                                <th>Return Date</th>
                                {{--<th>Status</th>--}}
                                <th>Created at</th>
                            </tr>
                            @foreach($sold as $fund)
                                <tr class="investment-table-row">
                                    <td></td>
                                    <td>{{$fund->id}}</td>
                                    <td>{{DB::table('posts')->select('title')->where('id',$fund->post_id)->implode('title')}}</td>
                                    <td>{{DB::table('businesses')->select('name')->where('user_id',$fund->business_owner)->implode('name')}}</td>
                                    <td>{{$fund->amount}}</td>
                                    <td>{{$fund->return_date}}</td>
                                    {{--<td>{{$fund->status}}</td>--}}
                                    <td>{{$fund->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="text-center">
                            {{ $sold->links() }}
                        </div>

                    @else
                        <p>You did not bought any investments</p>
                    @endif
                </div>
                <div id="menu2" class="tab-pane fade">



                    <h3>Completed</h3>
                    @if(count($completed) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Investment Title</th>
                                <th>Business Name</th>
                                <th>Amount</th>
                                <th>Return Date</th>
                                {{--<th>Status</th>--}}
                                <th>Created at</th>
                            </tr>
                            @foreach($completed as $fund)
                                <tr class="investment-table-row">
                                    <td></td>
                                    <td>{{$fund->id}}</td>
                                    <td>{{DB::table('posts')->select('title')->where('id',$fund->post_id)->implode('title')}}</td>
                                    <td>{{DB::table('businesses')->select('name')->where('user_id',$fund->business_owner)->implode('name')}}</td>
                                    <td>{{$fund->amount}}</td>
                                    <td>{{$fund->return_date}}</td>
                                    {{--<td>{{$fund->status}}</td>--}}
                                    <td>{{$fund->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="text-center">
                            {{ $completed->links() }}
                        </div>

                    @else
                        <p>You have no completed investments</p>
                    @endif
                </div>

                <div id="menu3" class="tab-pane fade">
                    <h3>Failed</h3>
                    @if(count($failed) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Investment Title</th>
                                <th>Business Name</th>
                                <th>Amount</th>
                                <th>Return Date</th>
                                {{--<th>Status</th>--}}
                                <th>Created at</th>
                            </tr>
                            @foreach($failed as $fund)
                                <tr class="investment-table-row">
                                    <td></td>
                                    <td>{{$fund->id}}</td>
                                    <td>{{DB::table('posts')->select('title')->where('id',$fund->post_id)->implode('title')}}</td>
                                    <td>{{DB::table('businesses')->select('name')->where('user_id',$fund->business_owner)->implode('name')}}</td>
                                    <td>{{$fund->amount}}</td>
                                    <td>{{$fund->return_date}}</td>
                                    {{--<td>{{$fund->status}}</td>--}}
                                    <td>{{$fund->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="text-center">
                            {{ $failed->links() }}
                        </div>

                    @else
                        <p>You have no failed investments</p>
                    @endif
                </div>
            </div>
        </div>




    </div>
</div>

