@extends('master')
@section('content')
<main id="about-us">
	<div class="wrapper">
		<section class="regular">
			<h1 id="subtitle">
				The Team
			</h1>
			<p>
				Let us introduce ourselves - this is our awesome team (this far), we all love to write
				and do so with a lot of passion, to deliver content of outstanding quality to you as
				a reader.
			</p>
			<div id="authors">
				@each('includes.user', $users, 'user')
			</div>
		</section>
		<section class="regular">
			<h1>
				More
			</h1>
			<p>
				Oh wowzie! You wanted to get to know something (more) about The Rad Elk, we reckon. Well first off, let us say we're glad to have you here. You're already one step ahead in becoming geekier with us.
			</p>
			<p>
				This website is the forest of knowledge where the one true Rad Elk scours, in his efforts of covering media and entertainment articles and news - he's versatile in gaming, music, events, audio and video production and much more, including science and travel - because believe it or not, we call him Rad because he's backed by a team of über-dedicated geeks from these good 'ol fields mentioned above. Did we mention he also loves tech? And humour. Astonishing this one...
			</p>
			<p>
				The creators, the ones that endorse the radest elk of 'em all are proud to have made it so far with nothing more, but a passion for learning, discovering and sharing. The Rad Elk is all about building a community of geeks, no matter what their favourite field(s) of media and entertainment are!
			</p>
			<p>
				In an interview with himself, the mastermind behind The Rad Elk - Alex Chiric, told us that "The Rad Elk is the platform I envisioned having ever since 2012, when I became outrageously passionate about tech tubers, gaming livestreams and music articles. [...] bought a camera, made some videos that never saw the light of YouTube, because I was too afraid of it not being good enough and embarrassing myself. I had plenty o' attempts starting my channel: first music, then gaming, then tech news...Never been able to make the leap. Fast forward to the end of 2017, I was chatting with my ol' gamer friend, whom I met in Battlefield 1. From that point on, things got serious...but not sexually. Ok, maybe a bit - after all, that's how we ended up with our baby Rad Elk in 2018, after endless discussions over how it should look like and be called."
			</p>
			<p>
				Through The Rad Elk, we ourselves also seek to discover and learn new things, for we're nowhere near being professionals - only professionally geekin'. So expect things to fail or be delayed from time to time, after all, nobody's perfect, ey? We are hungry for content and hope the same applies to you, because we've got plenty coming in! So why not grab a read or have a sneak peek of our website whilst you're here? You'll guaranteed to find something you like - or to steal, if that's your thing. That's the most flattering thing one person can do to you, apparently. But there are also repercussions. Still cool tho.
			</p>
			<p>
				Think you've learned something about us today? If so, that's pretty rad already. Not as rad as Daniel, who created this website from scratch, nor as the Rad Elk, but hey, that's one step closer! Why not go and learn something from our articles? Check out our posts and be sure to spread the word with your (imaginary) friend(s) - we want this herd to grow. The bigger, the better. If that happens, it shall be good for all of us. Pinky promise!
			</p>
		</section>
	</div>
</main>
@endsection