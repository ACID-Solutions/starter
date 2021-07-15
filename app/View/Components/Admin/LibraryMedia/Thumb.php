<?php

namespace App\View\Components\Admin\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Thumb extends Component
{
    public function __construct(public LibraryMediaFile|null $file = null)
    {
        //
    }

    public function render(): View
    {
        return view('components.admin.library-media.thumb');
    }
}
