@extends('master')
@section('content')
<main id="about-us">
	<div class="wrapper">
		<h1>
			contact
		</h1>
		<section id="desc">
			<p>
				Got any feedback or questions? We're eager to hear from you!
				We're also very flexible. You can either contact us directly via any social
				network listed below, or use the form on this page to contact us.
			</p>
			<p>
				We're very active on Facebook, Twitter and Discord - if you're active on any of
				those networks, feel free to reach out to us there instead, either via a post or
				direct message, that's up to you!
			</p>
			<p>
				We can't promise anything, but we're usually able to get back within 24 hours.
			</p>
			<form action="" id="subpage">
				<label for="">Your name</label>
				<input type="text">
				<label for="">E-Mail Address</label>
				<input type="text">
				<label for="">Choose a Subject</label>
				<select name="" id="">
					<option value="">Advertisement</option>
					<option value="">Feedback</option>
					<option value="">Question</option>
				</select>
				<label for="">Text</label>
				<textarea name="" id="" cols="30" rows="10"></textarea>
				<input type="submit" value="Send" id="submit">
			</form>
		</section>
	</div>
</main>
@endsection