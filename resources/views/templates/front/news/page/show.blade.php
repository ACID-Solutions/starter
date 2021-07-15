@extends('layouts.front.full')
@section('template')
    {!! $pageContent->displayBricks() !!}
    @brickableResourcesCompute
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-items-center">
                {{-- Filters --}}
                <x-form::form class="d-flex" :bind="request()">
                    <x-form::select class="mb-n3"
                                    name="category_id"
                                    hideLabel
                                    :options="App\Models\News\NewsCategory::pluck('title', 'id')->sortBy('title')->toArray()"/>
                    <x-form::button.submit class="btn-primary ms-3">
                        <i class="fas fa-filter fa-fw"></i>
                        {{ __('Filter') }}
                    </x-form::button.submit>
                    @if(request()->has(['category_id']))
                        <x-form::button.link class="btn-secondary ms-3" :href="route('news.page.show')">
                            <i class="fas fa-undo fa-fw"></i>
                            {{ __('Reset') }}
                        </x-form::button.link>
                    @endif
                </x-form::form>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                {{-- RSS --}}
                <a href="{{ route('feeds.news') }}"
                   title="{{ __(config('feed.feeds.news.title')) }}"
                   target="_blank">
                    <span class="fa-stack text-primary">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-rss fa-stack-1x fa-inverse"></i>
                    </span>
                    {{ __(config('feed.feeds.news.title')) }}
                </a>
            </div>
        </div>
    </div>
    <x-front.spacer typeKey="xs"/>
    {{-- Articles --}}
    <div class="container">
        <div class="row my-n3">
            @foreach($articles as $article)
                <div class="col-sm-6 col-lg-4 my-3">
                    <div class="card">
                        @if($image = $article->getFirstMedia('illustrations'))
                            <div>
                                {!! $image->img('card', ['class' => 'img-fluid card-img-top', 'alt' => $article->title]) !!}
                            </div>
                        @endif
                        <div class="card-body">
                            <h2 class="h5 card-title">{{ $article->title }}</h2>
                            <p class="small mt-n2">{{ Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</p>
                            @if($article->categories->isNotEmpty())
                                <div class="card-text small my-n1">
                                    @foreach($article->categories as $category)
                                        <a class="btn btn-secondary btn-sm my-1"
                                           href="{{ route('news.page.show', ['category_id' => $category->id]) }}"
                                           title="{{ $category->name }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <p class="card-text description mt-3">{!! Str::limit(strip_tags((new Parsedown)->text($article->description)), 500) !!}</p>
                            <a class="btn btn-primary stretched-link"
                               href="{{ route('news.article.show', $article->slug) }}"
                               title="{{ __('Know more') }}">
                                {{ __('Know more') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex flex-fill justify-content-center my-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
    <x-front.spacer typeKey="xl"/>
@endsection
