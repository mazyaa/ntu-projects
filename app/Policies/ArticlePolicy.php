<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['articles.view', 'articles.view_all']);
    }

    public function view(User $user, Article $article): bool
    {
        return $user->hasAnyPermission(['articles.view', 'articles.view_all'])
            || $article->author_id === $user->getKey();
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('articles.create');
    }

    public function update(User $user, Article $article): bool
    {
        if (! $user->hasPermissionTo('articles.edit')) {
            return false;
        }

        // Editors may only edit their own articles.
        if ($user->hasRole('Editor')) {
            return $article->author_id === $user->getKey();
        }

        return true;
    }

    public function delete(User $user, Article $article): bool
    {
        if (! $user->hasPermissionTo('articles.delete')) {
            return false;
        }

        // Editors may only delete their own articles.
        if ($user->hasRole('Editor')) {
            return $article->author_id === $user->getKey();
        }

        return true;
    }

    public function publish(User $user): bool
    {
        return $user->hasPermissionTo('articles.publish');
    }

    public function archive(User $user): bool
    {
        return $user->hasPermissionTo('articles.archive');
    }
}
