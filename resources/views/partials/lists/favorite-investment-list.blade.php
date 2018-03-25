<h3 class="page-header">Favorite Investments</h3>

    <div id="investment-list" class="row">
            @forelse ($myFavorites as $post)
                <div class="investment-item col-md-4">

                    <div class="investment-item-panel">
                   
                        <div class="investment-item-header" style="background-image: url({{$post->image}})">

                            

                        </div>

                        <div class="investment-item-body">
                            <h2 class="investment-item-title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                            <div class="rating" style="pointer-events: none;">
                                    <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs"> 
                                    <small>({{ $post->countRating() }})
                                        @if ($post->countRating() > 1)
                                            Ratings
                                        @else
                                            Rating
                                        @endif
                                    </small>
                            </div>
                            <p><a href="{{ route('business.show', ['business' => $post->user->business]) }}" class="no-underline">{{$post->user->business->name}}</a></p>
                            <p>Price: {{$post->price}}</p>
                            <p>Quantity: {{$post->quantity}}</p>

                            <hr/>

                            @if (Auth::check())
                                @if (Auth::user()->hasRole('investor'))
                                    <div class="text-center">
                                        <favorite
                                        :post={{ $post->id }}
                                        :favorited={{ $post->favorited() ? 'true' : 'false'}}
                                        ></favorite>
                                    </div>
                                @endif
                            @endif 
                        </div>

                    </div>

                </div>

            @empty
                <p>No Favorited investment.</p>
            @endforelse

</div>
