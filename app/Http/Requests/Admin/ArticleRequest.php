<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $article = $this->route('article');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:articles,slug'.($article ? ",{$article->getKey()}" : '')],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'cover' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['sometimes', 'boolean'],
            'status' => ['required', 'in:draft,published'],
            'scheduled_at' => ['nullable', 'date'],
        ];
    }
}
