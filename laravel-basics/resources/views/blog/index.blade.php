@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">The Beautiful Laravel</p>
        </div>
    </div>
    @foreach($posts as $post)
        <div class="row">
            <div class="col-md-12">
                <h1 class="post-title">{{ $post->title  }}</h1>
                <p style="font-weight: bold">
                    @foreach($post->tags as $tag)
                        - {{$tag->name}} -
                    @endforeach
                </p>
                <p>{{ $post->content  }}</p>
                <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">Read More...</a></p>
            </div>
        </div>
        <hr>
    @endforeach
    <div class="row">
        <div class="col-md-12 text-center">
            {{ $posts-> links() }}
        </div>
    </div>
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12">--}}
    {{--            <h1 class="post-title">The next Steps</h1>--}}
    {{--            <p>Understanding the basic is great,but you need to be able to make the next step</p>--}}
    {{--            <p><a href="{{ route('blog.post' , ['id' => 2]) }}">Read More...</a></p>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <hr>--}}
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12">--}}
    {{--            <h1 class="post-title">Laravel 5.3</h1>--}}
    {{--            <p>Though announced as the "minor-release", Laravel 5.3 ships with sooner very interesting additions and--}}
    {{--                features</p>--}}
    {{--            <p><a href="{{ route('blog.post', ['id' => 3]) }}">Read More...</a></p>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection
