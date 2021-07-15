<x-form::button.link class="btn-outline-primary btn-sm m-1"
                     data-clipboard-copy
                     :data-library-media-id="$file->id"
                     data-type="url">
    <i class="fas fa-link fa-fw"></i>
    {{ __('URL') }}
</x-form::button.link>
{{-- Todo: remove foreach loop and localization if your app is not multilingual --}}
@foreach(supportedLocaleKeys() as $localeKey)
    @if($file->can_be_displayed_on_page)
        <x-form::button.link class="btn-outline-primary btn-sm m-1"
                             data-clipboard-copy
                             :data-library-media-id="$file->id"
                             data-type="display"
                             :data-locale="$localeKey">
            <i class="fas fa-code fa-fw"></i>
            {{ __('HTML Display') }} ({{ strtoupper($localeKey) }})
        </x-form::button.link>
    @endif
    <x-form::button.link class="btn-outline-primary btn-sm m-1"
                         data-clipboard-copy
                         :data-library-media-id="$file->id"
                         data-type="download"
                         :data-locale="$localeKey">
        <i class="fas fa-code fa-fw"></i>
        {{ __('HTML Download') }} ({{ strtoupper($localeKey) }})
    </x-form::button.link>
@endforeach
