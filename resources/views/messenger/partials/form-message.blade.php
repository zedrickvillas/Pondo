<h3>Reply</h3>
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
    </div>


    <!-- Submit Form Input -->
    <div class="form-group">
        <button type="submit" class="btn btn-success">Send</button>
    </div>
</form>