<x-admin.forms.card title="{{ __('SEO') }}">
    <x-admin.media.thumb :media="$model->getFirstMedia('seo')"/>
    {{-- {{ inputCheckbox()->name('remove_meta_image') }}--}}
    <x-form::input type="file"
                   name="meta_image"
                   value="Test"
                   :caption="app(App\Models\PageContents\PageContent::class)->getMediaCaption('seo')"/>
    {{-- Todo: remove the "locales" attribute below if your app is not multilingual. --}}
    <x-form::input name="meta_title"
                   :locales="supportedLocaleKeys()"
                   :bind="$model->getAllMeta()"
                   :caption="__('Recommended length : around :count characters.', ['count' => 50])"
                   required/>
    <x-form::textarea name="meta_description"
                      :locales="supportedLocaleKeys()"
                      :bind="$model->getAllMeta()"
                      :caption="__('Recommended length : around :count characters.', ['count' => 150])"/>
</x-admin.forms.card>
