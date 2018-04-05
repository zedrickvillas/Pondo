@extends('layouts.app')


@section('content')

 <div class="panel panel-default">
 <h1>Wallet Balance</h1>
 <div class="well"><h3>{{$balance}}</h3></div>

 <a href="{{ url('wallet/addfunds') }}" class="btn btn-success">Add Wallet Funds</a>
 </div>

@endsection