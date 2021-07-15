@php
    $carouselId = 'carousel-brick-' . $brick->id;
    $slides = $brick->slides->where('active', true)->sortBy('position');
    $fullWidth = data_get($brick, 'data.full_width');
    $conversionName = $fullWidth ? 'full' : 'containerized';
@endphp
@if($slides->isNotEmpty())
    @unless($fullWidth)
        <div class="container">
            <div class="row">
    @endunless
    <div id="{{ $carouselId }}" class="carousel slide bg-dark w-100" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($slides as $key => $slide)
                <div class="carousel-item{{ $loop->first ? ' active' : null }}">
                    {!! $slide->getFirstMedia('images')->img($conversionName, ['class' => 'img-fluid', 'alt' => $slide->name]) !!}
                    @php
                        $label = $slide->label;
                        $caption = $slide->caption;
                    @endphp
                    @if($label || $caption)
                        <div class="carousel-caption d-none d-md-block">
                            @if($label)
                                <h5>{{ $label }}</h5>
                            @endif
                            @if($caption)
                                <p>{{ $caption }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @if($slides->count() > 1)
            <div class="carousel-indicators">
                @foreach($slides as $key => $slide)
                    <button class="{{ $loop->first ? 'active' : null }}" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $key }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $key }}"></button>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('Previous') }}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('Next') }}</span>
            </button>
        @endif
    </div>
    @unless($fullWidth)
            </div>
        </div>
    @endunless
@elseif(request()->is('admin/*') || request()->is('*/admin/*'))
    @unless($fullWidth)
        <div class="container">
            <div class="row">
    @endunless
        <div>
            <i class="fas fa-info-circle fa-fw text-info"></i>
            {{ __('No slides were added to this carousel.') }}
        </div>
    @unless($fullWidth)
            </div>
        </div>
    @endunless
@endif

