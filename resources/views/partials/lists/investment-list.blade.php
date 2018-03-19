<h3 class="page-header">Investments</h3>

    <div id="investment-list" class="row">
            @forelse ($posts as $post)
                <div class="investment-item col-sm-4">
                   
                    <div class="investment-item-header" style="background-image: url({{$post->image}})">

                        <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>

                        <p>
                            <form action="{{route('cart.store')}}" method="POST">

                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$post->id}}">
                                                        <input type="hidden" name="title" value="{{$post->title}}">
                                                        <input type="hidden" name="price" value="{{$post->price}}">
                                                        <button type="submit" class="button button-green"><i class="fa fa-cart-plus"></i></button>
                            </form>

                                                    {!!Form::close()!!}
                        </p>

                    </div>

                    <div class="investment-item-body">
                        <div class="rating">
                                <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs"> 
                                <small>{{ $post->countRating() }}
                                    @if ($post->countRating() > 1)
                                        Ratings
                                    @else
                                        Rating
                                    @endif
                                </small>
                        </div>
                        <p><a href="{{ route('business.show', ['business' => $post->user->business]) }}" class="no-underline">{{$post->user->business->name}}</a></p>
                        <p>{{$post->price}}</p>
                        <p>{{$post->quantity}}</p>
                    </div>

                    <div class="investment-item-footer">

                        @if (Auth::check())
                            @if (Auth::user()->hasRole('investor'))
                                <favorite
                                    :post={{ $post->id }}
                                    :favorited={{ $post->favorited() ? 'true' : 'false'}}
                                ></favorite>
                            @endif
                        @endif   


                    </div>

                </div>

            @empty
                <p>No investment.</p>
            @endforelse

</div>
