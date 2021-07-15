@extends('layouts.front.full')
@section('template')
    {{-- Cover --}}
    @if($image = $article->getFirstMedia('illustrations'))
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $image->img('cover', ['class' => 'img-fluid', 'alt' => $image->name]) !!}
                </div>
            </div>
        </div>
    @endif
    <x-front.spacer typeKey="xxs"/>
    {{-- Back button --}}
    <div class="container">
        <a href="route('news.page.show')" title="{{ __('Back') }}">
            <i class="fas fa-chevron-left fa-fw"></i>
            {{ __('Back') }}
        </a>
    </div>
    <x-front.spacer typeKey="lg"/>
    {{-- Categories / Sharing --}}
    <div class="container">
        <div class="row">
            <div class="col-sm-6 my-n1 my-sm-0">
                @if($article->categories->isNotEmpty())
                    @foreach($article->categories as $category)
                        <a class="btn btn-secondary btn-sm my-1"
                           href="{{ route('news.page.show', ['category_id' => $category->id]) }}"
                           title="{{ $category->name }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-6 mt-3 mt-sm-0 text-sm-end">
                <span class="fa-stack text-primary">
                    <a href="https://twitter.com/home?status={{ request()->url() }}"
                       title="{{ __('Share on :name', ['name' => 'Twitter']) }}"
                       target="_blank"
                       rel="noopener">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
                <span class="fa-stack text-primary">
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ request()->url() }}&title=&summary=&source={{ request()->getHttpHost() }}"
                       title="{{ __('Share on :name', ['name' => 'Linkedin']) }}"
                       target="_blank"
                       rel="noopener">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
                <span class="fa-stack text-primary">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
                       title="{{ __('Share on :name', ['name' => 'Facebook']) }}"
                       target="_blank"
                       rel="noopener">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
                <span class="fa-stack text-primary">
                    <a href="{{ route('feeds.news') }}"
                       title="{{ __(config('feed.feeds.news.title')) }}"
                       target="_blank"
                       rel="noopener">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-rss fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <x-front.spacer typeKey="xxs"/>
    {{-- Title --}}
    <x-front.title typeKey="h1" styleKey="h1" :title="$article->title"/>
    <x-front.spacer typeKey="sm"/>
    {{-- Description --}}
    <div class="container">
        <div class="row mb-n3">
            <div class="col-12 text">
                {!! (new Parsedown)->text($article->description) !!}
            </div>
        </div>
    </div>
    <x-front.spacer typeKey="xl"/>
@endsection
