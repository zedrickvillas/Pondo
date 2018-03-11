
<div class="media">
    <a class="pull-left" href="#">
        <img src=https://i.imgur.com/BFCAuJd.png{{ md5($message->user->email) }} ?s=64"
             alt="{{ $message->user->name }}" class="img-circle">
    </a>


    <div class="media-body">
  <!--      <h5 class="media-heading">{{ $message->user->name }}</h5> -->
            <h5 class="media-heading"><b>{{ $message->user->first_name }} {{ $message->user->last_name }}</b></h5>
      <p>{{ $message->body }}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>