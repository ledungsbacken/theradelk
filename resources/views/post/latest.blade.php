@extends('master')
@section('content')
<div id="startPage">
    <section id="latest">
        <header>
            <h1 id="subtitle">
                Recent
            </h1>
        </header>
        <main id="scrollLoader">
            @each('includes.post', $posts, 'post')
            <post-loader v-for="p in page" :key="p" :page="p" @done="isOver = false"></post-loader>
            <div v-if="page >= loadLimit">
                <a @click="loadMore()" id="loadmore" style="cursor: pointer;">
                    load more articles
                </a>
            </div>
        </main>
    </section>
</div>
@endsection

@push('script')
    <script src="{{ mix('js/scrollLoader.js') }}"></script>
@endpush
