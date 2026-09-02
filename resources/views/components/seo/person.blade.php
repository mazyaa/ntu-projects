@props(['person'])

@php
    $personJsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $person->name,
        'jobTitle' => $person->position,
        'worksFor' => [
            '@type' => 'Organization',
            'name' => company('name'),
        ],
    ];
@endendphp

<script type="application/ld+json">
{!! json_encode($personJsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
