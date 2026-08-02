<x-mail::message>
# Pesan Kontak Baru

Sebuah pesan baru telah masuk melalui form kontak situs.

**Nama:** {{ $contact->name }}

**Email:** {{ $contact->email }}

@if($contact->phone)
**Telepon:** {{ $contact->phone }}
@endif

@if($contact->subject)
**Subjek:** {{ $contact->subject }}
@endif

**Pesan:**

{{ $contact->message }}

<x-mail::button :url="panel_route('contacts.show', $contact)">
Buka di Inbox Admin
</x-mail::button>

Salam,<br>
{{ config('company.name') }}
</x-mail::message>
