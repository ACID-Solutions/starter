@extends('layouts.front.full')
@section('template')
    <div id="news-show" class="container my-5">
        {{-- cover --}}
        <div class="row">
            {{ $article->getFirstMedia('illustrations')('cover') }}
            {{-- categories / sharing --}}
            <div class="d-flex flex-wrap flex-grow-1 align-items-center justify-content-between py-3">
                <div>
                    @if($article->categories->isNotEmpty())
                        @foreach($article->categories as $category)
                            <a class="btn btn-secondary btn-sm"
                               href="{{ route('news', ['category_id' => $category->id]) }}"
                               title="{{ $category->title }}">
                                {{ $category->title }}
                            </a>
                        @endforeach
                    @endif
                </div>
                <div>
                    <span class="fa-stack text-primary">
                        <a class="new-window"
                           href="https://twitter.com/home?status={{ request()->url() }}"
                           title="@lang('static.action.socialShare', ['social' => 'Twitter'])">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                    <span class="fa-stack text-primary">
                        <a class="new-window"
                           href="https://www.linkedin.com/shareArticle?mini=true&url={{ request()->url() }}&title=&summary=&source={{ request()->getHttpHost() }}"
                           title="@lang('static.action.socialShare', ['social' => 'Linkedin'])">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                    <span class="fa-stack text-primary">
                        <a class="new-window"
                           href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
                           title="@lang('static.action.socialShare', ['social' => 'Facebook'])">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                </div>
            </div>
            {{-- description --}}
            <div class="d-flex w-100 flex-column text mt-3">
                <h1 class="mb-4">{{ $article->title }}</h1>
                {!! (new Parsedown)->text($article->description) !!}
                <div class="mt-3">
                    <a class="btn btn-link spin-on-click"
                       href="{{ route('news') }}"
                       title="@lang('static.action.back')">
                        <i class="fas fa-chevron-left fa-fw"></i>
                        @lang('static.action.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
