<?php

namespace App\View\Components\Admin\Media;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Thumb extends Component
{
    public function __construct(public Media|null $media = null)
    {
        //
    }

    public function render(): View
    {
        return view('components.admin.media.thumb');
    }
}
