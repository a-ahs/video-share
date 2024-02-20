<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVideoRequest extends StoreVideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(),[
            'slug' => ['required', Rule::unique('videos')->ignore($this->video), 'alpha_dash'],
            'file' => ['file', 'mimetypes:video/mp4', 'nullable'],
        ]);
    }
}
