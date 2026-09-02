@props(['article'])

@php
    $author = $article->author;
    $articleJsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $article->title,
        'description' => $article->excerpt ?? strip_tags(\Illuminate\Support\Str::limit($article->content, 200)),
        'datePublished' => $article->published_at?->toIso8601String(),
        'dateModified' => $article->updated_at?->toIso8601String(),
        'author' => $author ? [
            '@type' => 'Person',
            'name' => $author->name,
        ] : [
            '@type' => 'Organization',
            'name' => company('name'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => company('name'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo/navbar-logo.png'),
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => url()->current(),
        ],
    ];

    if ($article->thumbnail) {
        $articleJsonLd['image'] = asset('storage/' . $article->thumbnail);
    }
@endphp

<script type="application/ld+json">
{!! json_encode($articleJsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
