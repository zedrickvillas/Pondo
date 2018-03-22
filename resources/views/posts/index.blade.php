@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
      <div class="panel-heading"><h1>Investments</h1></div>
      <div class="panel-body">
        


        @if(count($posts) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Investment Title</th>
                    <th>Company</th>
                    <th>Amount (PHP)</th>
                    <th>Quantity Left</th>
                    <th></th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                        <td>
                          <a href="{{ route('business.show', ['business' => $post->user->business]) }}" class="no-underline">{{$post->user->business->name}}</a>
                        </td>
                        <td>{{$post->price}}</td>
                        <td>{{$post->quantity}}</td>
                        <td>

                            <form action="{{route('cart.store')}}" method="POST">

                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$post->id}}">
                                <input type="hidden" name="title" value="{{$post->title}}">
                                <input type="hidden" name="price" value="{{$post->price}}">
                                <button type="submit" class="button button-green"><i class="fa fa-cart-plus"></i></button>
                            </form>

                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No post.</p>
        @endif
      </div>
    </div>


   {{-- @if(count($posts))--}}
   {{--     @foreach($posts as $post)--}}
   {{--         <div class="well">--}}
   {{--             <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>--}}
   {{--             <small>Written on {{$post->created_at}}</small>--}}
   {{--         </div>--}}
   {{--     @endforeach--}}
   {{-- @else--}}
   {{--     <p> No post found</p>--}}
   {{-- @endif--}}
@endsection
