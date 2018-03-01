<div class="row mb-2">
	<div class="col-md-4">
		<div class="col-content text-center border-shadow p-1 module">
			<a href="{{ route('business.show', ['business' => Auth::user()->business->id]) }}" class="no-underline">
				<h1 class="text-large"><i class="fa fa-building" aria-hidden="true"></i></h1>
				<h3>Your Business</h3>
			</a>
		</div>
	</div>
</div>
