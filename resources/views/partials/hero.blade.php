<div id="hero-container" style="background-image: url({{ asset('images/welcome/hero.jpg') }})">
	<div id="overlay">
		<div id="hero-content" class="d-flex">
			<div id="msg" class="mb-2">
				<h1>{{ $post->title }}</h1>
			</div>
		</div>
	</div>
</div>


<div id="breadcrumb-container">
	<div class="container mb-2">
		{{ Breadcrumbs::render('investment', $post->title) }}
	</div>
</div>
