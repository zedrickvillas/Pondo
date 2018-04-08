@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')
    {!! Form::open(['action' => 'TransactionController@store', 'method' => 'POST']) !!}
    <div class='container-fluid'>
        <h1>CREATE</h1>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            </thead>

            <tbody>

            <?php foreach(Cart::content() as $row) :?>

            <tr>
                <td>
                    <p><strong><a href="/posts/{{$row->id}}"><?php echo $row->name; ?></a></strong></p>
                    <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
                </td>
                <td><?php echo $row->qty; ?>pcs.</td>
                <td>₱<?php echo $row->price; ?></td>
                <td>₱<?php echo (($row->price)*($row->qty)); ?></td>

                <td></td>
            </tr>

            <?php endforeach;?>

            </tbody>

            <tfoot>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td>Subtotal</td>
                <td>₱<?php echo Cart::subtotal(); ?></td>
            </tr>


            </tfoot>
        </table>

        <hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-bordered">
                        <tr>
                            <td>Wallet Funds</td>
                            <td>₱{{Form::label($data['balance'], $data['balance'])}}</td>

                        </tr>
                        <tr>
                            <td>Purchase </td>
                            <td>(₱{{Form::label($data['purchase'],$data['purchase'])}})</td>
                        </tr>
                        <tr>
                            <th><h4>Funds After Purchase</h4></th>
                            <td><h4>₱{{Form::label($data['fundsAfterPurchase'],$data['fundsAfterPurchase'])}}</h4></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        {{ Form::hidden('invisible', 'secret') }}

        <hr>
        <div class="container">
            <p>Transaction Type: {{Form::label('Purchase','Purchase')}}</p>
            <p>Payment Method: WALLET</p>
            <p>Wallet Account holder: <?php echo auth()->user()->name; ?></p>
            {{--</br><a href="{{ route('transaction.store') }}" class="btn btn-success mt-3">BUY</a>--}}

            <p>{{Form::submit('Proceed', ['class'=>'btn btn-primary '])}}</p>
            {!! Form::close() !!}
        </div>


    </div>



@endsection

@section('footer_scripts')
@endsection