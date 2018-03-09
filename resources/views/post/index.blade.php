@extends('master')
@section('content')
    <div class="wrapper">
        <section id="collage" style="border:solid 5px #649173;border-top:none;">
            <a href="http://theradelk.test/#/post/play-pok%C3%A9mon-for-free-on-your-windows-computer-or-android-device" class="item">
                <div class="hoverLayer">
                    <img src="http://danielljungqvist.se/images/big/image/vMEHZVXTbd.jpg" alt="">
                </div>
                    <div class="underLay">
                        <header>
                            <h2>Corey Taylor says Slipknot's next album is gonna by 'heavy'</h2>
                            <span>by <strong>Daniel Ljungqvist</strong> in <strong>Music</strong></span>
                        </header>
                    </div>
            </a>
            <a href="http://theradelk.test/#/post/save-those-great-snaps-of-yours-for-usage-outside-of-snapchat" class="item">
                <div class="hoverLayer">
                    <img src="http://danielljungqvist.se/images/big/image/gTMpQzeJsP.jpg" alt="">
                </div>
                    <header>
                        <h2>Download images and videos from you AirDroid to your Computer</h2>
                        <span>by <strong>Daniel Ljungqvist</strong> in <strong>Tech</strong></span>
                    </header>
            </a>
            <a href="http://theradelk.test/#/post/spacex-has-now-launched-the-world's-biggest-rocket-to-space-with-a-car-in-it" class="item">
                <div class="hoverLayer">
                    <img src="https://danielljungqvist.se/images/big/image/RiAPrmS8jp.jpg" alt="">
                </div>
                <header>
                    <h2>Red Dead Redemption 2 to be released 26th of October</h2>
                    <span>by <strong>Daniel Ljungqvist</strong> in <strong>Tech</strong></span>
                </header>
            </a>
        </section>
        <section id="latest">
            <main>
                @each('includes.post', $posts, 'post')
            </main>
        </section>
    </div>
@endsection
