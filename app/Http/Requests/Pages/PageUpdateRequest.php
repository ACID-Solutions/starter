<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\AbstractSeoRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageUpdateRequest extends AbstractSeoRequest
{
    public function rules(): array
    {
        $rules = ['active' => ['required', 'boolean']];
        $localizedRules = localizeRules([
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('pages')->ignore($this->page->id),
            ],
            'nav_title' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge(['active' => (bool) $this->active]);
    }
}
