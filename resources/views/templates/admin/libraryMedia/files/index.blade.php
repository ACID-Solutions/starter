@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @lang('admin.title.orphan.index', ['entity' => __('entities.libraryMedia')])
    </h1>
    <hr>
    <div class="card">
        <div class="card-header">
            <h2 class="m-0">
                @lang('admin.section.list')
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('libraryMedia.files.index') }}" class="d-flex justify-content-end">
                @foreach($request->except('category_id') as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                {{ bsSelect()->name('category_id')
                    ->prepend('<i class="fas fa-tags fa-fw"></i>')
                    ->label(false)
                    ->options((new \App\Models\LibraryMediaCategory)->orderBy('name')->get(), 'id', 'name')
                    ->selected('id', $request->category_id)
                    ->componentClasses(['selector']) }}
                {{ bsValidate()->prepend('<i class="fas fa-filter"></i>')->label(__('library-media.actions.filter'))->containerClasses(['ml-3']) }}
                @if($request->has('category_id'))
                    {{ bsCancel()->route('libraryMedia.files.index')->prepend('<i class="fas fa-undo"></i>')->label(__('library-media.actions.reset'))->containerClasses(['ml-3']) }}
                @endif
            </form>
            {{ $table }}
        </div>
    </div>
@endsection
