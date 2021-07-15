@switch($file->type)
@case('image')
<div class="my-3">{!! $media->img('', ['class' => 'img-fluid', 'alt' => $file->name]) !!}</div>
@break
@case('pdf')
{{-- Todo: remove locale in translation if your app is not multilingual --}}
<div class="my-3"><a href="{{ $media->getUrl() }}" title="{{ $file->name }}" data-lightbox><img src="{{ $media->getUrl('thumb') }}" alt="{{ $file->name }}"><span class="mt-1 d-block small"><i class="fas fa-search-plus fa-fw me-1"></i>{{ __('Preview', [], $locale) }} {{ $file->name }}</span></a></div>
@break
@case('audio')
<div class="my-3"><audio controls><source src="{{ $media->getUrl() }}" type="{{ $media->mime_types }}"/>{{ __('Your browser does not support the audio tag.') }}</audio></div>
@break
@case('video')
<div class="my-3"><video controls preload="1" class="mw-100"><source src="{{ $media->getUrl() }}">{{ __('Your browser does not support the video tag.') }}</video></div>
@break
@endswitch
