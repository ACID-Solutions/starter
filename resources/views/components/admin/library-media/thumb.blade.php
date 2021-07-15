@if($media = $file?->getFirstMedia('media'))
    <div {{ $attributes ?? null }}>
        @if($file->can_be_previewed_in_popin)
            <a href="{{ $media->getUrl() }}" title="{{ __('Preview') }} {{ $file->name }}" data-lightbox>
        @else
            <a href="{{ $media->getUrl() }}" title="{{ __('Download') }} {{ $file->name }}" download="{{ $media->file_name }}">
        @endif
        @if($file->has_preview_image)
            <x-admin.media.thumb :media="$media"/>
        @else
            {!! $file->icon !!}
        @endif
        </a>
    </div>
@endif
