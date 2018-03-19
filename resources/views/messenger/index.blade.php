@extends('layouts.app')

@section('content')

	<a href="{{ route('messages.create') }}"><i class="fa fa-pencil" aria-hidden="true"></i>Compose Message</a>
    @include('messenger.partials.flash')

    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
@stop
