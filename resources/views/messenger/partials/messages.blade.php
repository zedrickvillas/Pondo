<div class="media">
    <a class="pull-left" href="#">

        @if ($message->user->profile->avatar == null)
        <img src="https://i.imgur.com/BFCAuJd.png{{ md5($message->user->email) }} ?s=64"
             alt="{{ $message->user->name }}" class="img-circle"> 
        @else
        <img src="{{ $message->user->profile->avatar }}" style="width: 70px;"
             alt="{{ $message->user->name }}" class="img-circle">
        @endif
        
    </a>
    <div class="media-body">
        <h5 class="media-heading"><b>{{ $message->user->first_name }} {{ $message->user->last_name }}</b></h5>
        <p>{{ $message->body }}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>