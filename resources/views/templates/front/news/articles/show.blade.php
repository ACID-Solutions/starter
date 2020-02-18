@extends('layouts.front.full')
@section('template')
    {{-- cover --}}
    @if($image = $article->getFirstMedia('illustrations'))
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 mb-3">
                    {!! $image->img('cover', ['class' => 'w-100', 'alt' => $image->name]) !!}
                </div>
            </div>
        </div>
    @endif
    {{-- categories / sharing --}}
    <div class="container mt-2 mb-5">
        <div class="row">
            <div class="col-sm-6 my-1 my-sm-0">
                @if($article->categories->isNotEmpty())
                    @foreach($article->categories as $category)
                        <a class="btn btn-secondary btn-sm"
                           href="{{ route('news', ['category_id' => $category->id]) }}"
                           title="{{ $category->name }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-6 my-1 my-sm-0 text-sm-right">
                <span class="fa-stack text-primary">
                    <a class="new-window"
                       href="https://twitter.com/home?status={{ request()->url() }}"
                       title="@lang('Share on :name', ['name' => 'Twitter'])">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
                <span class="fa-stack text-primary">
                    <a class="new-window"
                       href="https://www.linkedin.com/shareArticle?mini=true&url={{ request()->url() }}&title=&summary=&source={{ request()->getHttpHost() }}"
                       title="@lang('Share on :name', ['name' => 'Linkedin'])">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
                <span class="fa-stack text-primary">
                    <a class="new-window"
                       href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
                       title="@lang('Share on :name', ['name' => 'Facebook'])">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
                <span class="fa-stack text-primary">
                    <a class="new-window"
                       href="{{ route('feeds.news') }}"
                       title="@lang(config('feed.feeds.news.title'))">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-rss fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
    {{-- title --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">{{ $article->title }}</h1>
                <hr>
            </div>
        </div>
    </div>
    {{-- description --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text">
                {!! (new Parsedown)->text($article->description) !!}
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text">
                {{ buttonLink()->route('news')
                    ->prepend('<i class="fas fa-chevron-left fa-fw"></i>')
                    ->label(__('Back')) }}
            </div>
        </div>
    </div>
@endsection
