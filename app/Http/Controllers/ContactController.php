<?php

namespace App\Http\Controllers;

use App\Enums\ContactStatus;
use App\Http\Requests\Public\ContactRequest;
use App\Mail\ContactNotification;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact', [
            'company' => config('company'),
        ]);
    }

    public function store(ContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'status' => ContactStatus::Unread,
            'ip_address' => $request->ip(),
        ]);

        $this->notify($contact);

        return back()->with('success', 'Pesan Anda telah terkirim. Tim kami akan segera menghubungi Anda.');
    }

    private function notify(Contact $contact): void
    {
        $setting = Setting::query()
            ->where('group', 'general')
            ->where('key', 'inbox_notify_email')
            ->first();

        $recipient = $setting?->decodedValue();

        if (! $recipient) {
            return;
        }

        try {
            Mail::to($recipient)->send(new ContactNotification($contact));
        } catch (\Throwable $e) {
            Log::warning('Gagal mengirim notifikasi kontak: '.$e->getMessage());
        }
    }
}
