

<div id="investment-list" class="row">

    <div>
        <h3 class="page-header">Investments</h3> 
    </div>
    


            @forelse ($posts as $post)
                <div class="investment-item col-md-4">

                    <div class="investment-item-panel">

                        <a href="/posts/{{$post->id}}">
                            <div class="investment-item-header" style="background-image: url({{$post->image}})"></div>

                            <div class="investment-item-body">
                                <h2 class="investment-item-title">{{$post->title}}</h2>

                                <span class="price-tag .wordwrap"><small>₱</small> {{$post->price}}</span>
                                <p>Quantity: {{ DB::table('funds')->select('id')->where(['post_id' => $post->id,'status' => "Available"])->get()->count()}}</p>

                                {{--{{//Fund::where(['post_id' => $post->id,'status' => "Available"])->count()}}--}}

                                <p>ROI: {{$post->roi}}</p>

                                <div class="d-flex likes-ratings">
                                    <span class="likes">
                                        @if ($post->followersCount() > 0)
                                            <i class="fa fa-heart"></i> 
                                        @else
                                            <i class="fa fa-heart-o"></i> 
                                        @endif
                                        

                                        {{ $post->followersCount() }}</span>
                                     <div class="rating" style="pointer-events: none;">
                                        <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs"> 
                                        <small>({{ $post->countRating() }})</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
            @empty
                <p>No investment</p>
            @endforelse

</div>

<div class="text-center">
    {!! $posts->links() !!}
</div>
