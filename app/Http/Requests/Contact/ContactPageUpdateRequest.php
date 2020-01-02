<?php

namespace App\Http\Requests\Contact;

use App\Http\Requests\Request;
use App\Services\Seo\SeoService;

class ContactPageUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->localizeRules(array_merge([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:65535'],
        ], (new SeoService)->metaTagsRules()));
    }
}