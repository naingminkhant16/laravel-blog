<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('update', $this->route('post'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => "required|min:3|max:255|unique:posts,title," . $this->route('post')->id,
            'body' => "required|min:5",
            'photos.*' => "mimes:png,jpg|file|max:512",
            'image' => "mimes:png,jpeg|file|max:512|nullable",
            'category' => "required|exists:categories,id"
        ];
    }
}
