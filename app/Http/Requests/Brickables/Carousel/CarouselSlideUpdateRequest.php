<?php

namespace App\Http\Requests\Brickables\Carousel;

use App\Models\Brickables\CarouselBrickSlide;
use Illuminate\Foundation\Http\FormRequest;

class CarouselSlideUpdateRequest extends FormRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'image' => app(CarouselBrickSlide::class)->getMediaValidationRules('images'),
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'label' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['active' => (bool) $this->active]);
    }
}
