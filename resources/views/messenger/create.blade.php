@extends('layouts.app')

@section('template_linked_css')
    <style>
        #message-create {
            width: 500px;
            margin: 0 auto;
        }

    </style>
@endsection


@section('content')
    <div id="message-create">
        <h1>Create a new message</h1>
        <form action="{{ route('messages.store') }}" method="post">
            {{ csrf_field() }}
            <div>
                <!-- Subject Form Input -->
                <div class="form-group">
                    <label class="control-label">Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                           value="{{ $investment_title }}" style="pointer-events: none">

                    @if ($errors->has('subject'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif
                </div>

                <!-- Message Form Input -->
                <div class="form-group">
                    <label class="control-label">Message</label>
                    <textarea name="message" class="form-control">{{ old('message') }}</textarea>

                    @if ($errors->has('message'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>

         
                <div class="checkbox" style="visibility: hidden;">
                    <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]"
                                                                    value="{{ $user->id }}" checked>{!!$user->name!!}</label>
                </div>
             
        
                <!-- Submit Form Input -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </div>
        </form>
    </div>
@stop
