@extends('layouts.master')

@section('content')
    @include('messenger.partials.flash')

    @each('messenger.partials.thread', 'thread', 'messenger.partials.no-threads')
@stop
