<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContactStatus;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = Contact::latest();

        if ($request->filled('status')) {
            $status = $request->string('status')->toString();

            if (in_array($status, array_column(ContactStatus::cases(), 'value'), true)) {
                $query->where('status', $status);
            }
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(15)->withQueryString();

        $counts = [
            'unread' => Contact::unread()->count(),
            'total' => Contact::count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'counts'));
    }

    public function show(Contact $contact): View
    {
        if ($contact->status === ContactStatus::Unread) {
            $contact->update([
                'status' => ContactStatus::Read,
                'read_at' => now(),
            ]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markStatus(Contact $contact, Request $request): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:unread,read,replied,archived'],
        ]);

        $status = ContactStatus::from($request->string('status'));

        $contact->update([
            'status' => $status,
            'read_at' => $status === ContactStatus::Read || $status === ContactStatus::Replied ? now() : $contact->read_at,
            'replied_at' => $status === ContactStatus::Replied ? now() : $contact->replied_at,
        ]);

        return back()->with('success', 'Status pesan diperbarui.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect(panel_route('contacts.index'))->with('success', 'Pesan kontak dihapus.');
    }
}
