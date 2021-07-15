<?php

namespace App\View\Components\Admin\LibraryMedia\ClipboardCopy;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Buttons extends Component
{
    public function __construct(public LibraryMediaFile|null $file = null)
    {
        //
    }

    public function render(): View
    {
        return view('components.admin.library-media.clipboard-copy.buttons');
    }
}
