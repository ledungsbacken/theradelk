<div class="author">
<a href="/user/{{ $user->id }}" class="authLink"></a>
	<div class="image_header">
		<div class="image_social">
			<div class="filter">
				<img src="{{ $user->picture }}" alt="">
			</div>
			<ul class="socials inline">
				@each('includes.country', $user->socialLinks, 'socialLink')
			</ul>
		</div>
	</div>
	<header>
		<h3>{{ $user->name }}</h3>
		<div class="authorInfor">
			<div class="location">
				<i class="fas fa-map-marker"></i>
				<p>{{ $user->country }}</p>
			</div>
		</div>
	</header>
</div>