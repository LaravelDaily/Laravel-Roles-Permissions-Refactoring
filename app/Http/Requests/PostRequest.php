<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'post_text' => ['required'],
            'is_published' => ['boolean', Rule::when(auth()->user()->role_id == User::ROLE_USER, 'prohibited')]
        ];
    }

    public function authorize()
    {
        return true;
    }
}
