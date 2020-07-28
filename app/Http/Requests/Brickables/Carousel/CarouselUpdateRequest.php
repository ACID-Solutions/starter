<?php

namespace App\Http\Requests\Brickables\Carousel;

use Illuminate\Foundation\Http\FormRequest;

class CarouselUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'full_width' => ['required', 'boolean'],
            'image' => $this->brick->brickable->getBrickModel()->getMediaValidationRules('slides'),
        ];
        $localizedRules = localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    protected function prepareForValidation()
    {
        $this->merge(['full_width' => (bool) $this->full_width]);
    }
}