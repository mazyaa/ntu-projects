@props(['service'])

@php
    $serviceJsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service->name,
        'description' => $service->short_description ?? $service->description,
        'provider' => [
            '@type' => 'ProfessionalService',
            'name' => company('name'),
            'url' => url('/'),
        ],
        'areaServed' => 'ID',
        'serviceType' => 'Riksa Uji K3',
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($serviceJsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
