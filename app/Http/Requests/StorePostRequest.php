<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin() || Auth::user()->isAuthor() || Auth::user()->isEditor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => "required|unique:posts,title|min:3|max:25",
            'body' => "required|min:5",
            'photos' => "required",
            'photos.*' => "mimes:png,jpg|file|max:512",
            'image' => "mimes:png,jpeg|file|max:512|nullable",
            'category' => "required|exists:categories,id"
        ];
    }
}
