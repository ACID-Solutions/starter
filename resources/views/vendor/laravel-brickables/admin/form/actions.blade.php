<div class="d-flex">
    <a class="btn btn-secondary me-2" href="{{ $adminPanelUrl }}" role="button">
        <i class="fas fa-undo fa-fw"></i> {{ __('Back') }}
    </a>
    <button class="btn btn-primary" type="submit">
        @if($brick)
            <i class="fas fa-save fa-fw"></i> {{ __('Update') }}
        @else
            <i class="fas fa-plus-circle fa-fw"></i> {{ __('Create') }}
        @endif
    </button>
</div>
