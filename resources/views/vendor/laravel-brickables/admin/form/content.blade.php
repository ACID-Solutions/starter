@yield('prepend')
<x-form::form :method="$brick ? 'PUT' : 'POST'"
              :action="$brick ? $brickable->getUpdateRoute($brick) : $brickable->getStoreRoute()"
              enctype="multipart/form-data">
    <input type="hidden" name="model_id" value="{{ $model->id }}">
    <input type="hidden" name="model_type" value="{{ get_class($model) }}">
    <input type="hidden" name="brickable_type" value="{{ get_class($brickable) }}">
    <input type="hidden" name="admin_panel_url" value="{{ $adminPanelUrl }}">
    @hasSection('actions')
        @yield('actions')
    @else
        @include('laravel-brickables::admin.form.actions')
    @endif
    @hasSection('form_body')
        @yield('form_body')
    @else
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col mb-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="m-0">
                            @hasSection('title')
                                @yield('title')
                            @else
                                {{ __('Brick data') }}
                            @endif
                        </h2>
                    </div>
                    <div class="card-body">
                        @yield('inputs')
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-form::form>
@yield('append')
