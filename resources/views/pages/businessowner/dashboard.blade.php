@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            	<h1>{{Auth::user()->name}}'s Dashboard</h1>


                {{--<div class="form-group">
                    <label class="form-label">Business Name: </label>
                    <div class="form-control">{{Auth::user()->business->name}}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Business Nature: </label>
                    <div class="form-control">{{Auth::user()->business->nature}}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Business Address: </label>
                    <div class="form-control">{{Auth::user()->business->address}}</div>
                </div>--}}


                @include('panels.businessowner.modules')

                <a href="{{ route('posts.create') }}" class="btn btn-primary pull-right">Create Post</a>

                @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'style' => 'display: inline-block;'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p>You have no posts</p>
                @endif

                


            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection