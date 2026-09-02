@php
    $currentUrl = url()->current();
    @endphp
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "{{ company('name') }}",
    "alternateName": "{{ company('short_name') }}",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo/navbar-logo.png') }}",
    "description": "{{ __('ui.meta.description') }}",
    "foundingDate": "2020-10-22",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ company('contact.address') }}",
        "addressLocality": "{{ company('contact.city') }}",
        "addressCountry": "ID"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ company('contact.phone') }}",
        "contactType": "customer service",
        "email": "{{ company('contact.email') }}",
        "availableLanguage": ["Indonesian", "English"]
    },
    "sameAs": [
        "https://www.linkedin.com/company/{{ company('slug') }}",
        "https://www.instagram.com/{{ company('slug') }}"
    ],
    "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Layanan Riksa Uji K3",
        "itemListElement": [
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Riksa Uji Pesawat Angkat",
                    "description": "Pemeriksaan dan pengujian teknis pesawat angkat meliputi crane, hoist, dongkrak, dan peralatan pengangkatan lainnya."
                }
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Riksa Uji Pesawat Angkut",
                    "description": "Pemeriksaan dan pengujian teknis pesawat angkut meliputi forklift, truk, trailer, dan peralatan pengangkutan lainnya."
                }
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Inspeksi Teknis K3",
                    "description": "Layanan inspeksi teknis dan pengujian untuk memastikan keselamatan peralatan kerja sesuai standar K3."
                }
            }
        ]
    }
}
</script>
