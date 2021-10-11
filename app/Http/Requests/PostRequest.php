<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'post_text' => ['required'],
            'is_published' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}