@if($media)
    <a class="d-flex mb-2" href="{{ $media->getUrl() }}" title="{{ $media->file_name }}" data-lightbox>
        {{ $media->img('thumb', ['class' => 'rounded-circle', 'alt' => $media->file_name]) }}
    </a>
@endif
