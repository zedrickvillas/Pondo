@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}

@endsection

@section('head')
@endsection

@section('content')

    <div class="panel panel-body">
        <div class="panel-body">
                <h1>Investment Return</h1>
                <hr>


                <table class="table table-default">
                    <tr class="info"><span style="font-weight:bold">
                        <td><span style="font-weight:bold">Investor</span></td>
                        <td><span style="font-weight:bold">Date Purchased</span></td>
                        <td><span style="font-weight:bold">Amount</span></td>
                    </span>
                    </tr>

                            {{--@foreach($data['funds'] as $fund)--}}

                        @foreach($sold as $sold)
                            <tr>
                                <td>{{$sold->investor}}</td>
                                <td>{{$sold->created_at}}</td>
                                <td>{{$sold->amount}}</td>
                            </tr>
                        @endforeach

                </table>
        </div>

        <div class="panel panel-body">
             {!! Form::open(['action' => 'PostsController@total_investment', 'method' => 'POST'])!!}

            <div class="form-group">
                {{ Form::hidden('post_id', $post->id )}}
                {{Form::label('return_label', 'Cost of Return Investment')}}
                {{Form::text ('cost_return_investment', '' , ["class" => "form-control"] )}}
                @if ($errors->has('cost_return_investment'))
                    <span class="text-danger">
                            <strong>{{ $errors->first('cost_return_investment') }}</strong>
                        </span>
                @endif


            </div>

            {{Form::submit('Proceed', ['class'=>'btn btn-primary mt-2'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection