@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}

@endsection

@section('head')
@endsection

@section('content')
    {!! Form::open(['action' => 'PostsController@request_investment_return', 'method' => 'POST']) !!}
    <div class="panel panel-body">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-bordered">
                        <tr>
                            <td>Wallet Funds</td>
                            <td>₱{{Form::label($data['balance'], $data['balance'])}}</td>

                        </tr>
                        <tr>
                            <th>Return Investment Price</th>
                            <td>₱{{Form::label($data['amount_return_investment'],$data['amount_return_investment'])}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>*</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{Form::label($data['quantity'],$data['quantity'])}}</td>
                        </tr>
                        <tr>
                            <th>SUBTOTAL</th>
                            <td>(₱{{Form::label($data['purchase'],$data['purchase'])}})</td>
                        </tr>
                        <tr>
                            <th><h4>Wallet Funds After Purchase</h4></th>
                            <td><h4>₱{{Form::label($data['fundsAfterPurchase'],$data['fundsAfterPurchase'])}}</h4></td>
                        </tr>
                    </table>
                    <div class="container">
                        <p>Transaction Type: Return Investment</p>
                        <p>Payment Method: WALLET</p>
                        <p>Wallet Account holder: <?php echo auth()->user()->name; ?></p>
                        {{ Form::hidden('post_id', $data['post_id'])}}
                        {{ Form::hidden('transaction_type', 'Return Investment')}}
                        <p>{{Form::submit('Proceed', ['class'=>'btn btn-primary '])}}</p>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <?php /*
            <h1>Eyyyy</h1>
            {{$data['post']}}
            <hr>

            {{$data['sold']}}

            <table class="table table-default">
                <tr class="info"><span style="font-weight:bold">
                        <td><span style="font-weight:bold">Investor</span></td>
                        <td><span style="font-weight:bold">Date Purchased</span></td>
                        <td><span style="font-weight:bold">Amount</span></td>
                    </span>
                </tr>

                {{--@foreach($data['funds'] as $fund)--}}

                @foreach($data['sold'] as $sold)
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
            <h1>Eyyyy</h1>

            <div class="form-group">
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
                */ ?>
        </div>
    </div>
@endsection