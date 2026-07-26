<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles contact messages from the public website.
 */
class ContactController extends Controller
{
    /**
     * Store a contact message from a visitor.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($request->only('name', 'email', 'message'));

        return back()->with('contact_success', 'Mensaje enviado correctamente. Te responderemos pronto.');
    }

    /**
     * Display a paginated list of contact messages for administrators.
     *
     * @return View
     */
    public function index(): View
    {
        $messages = ContactMessage::latest()->paginate(20);

        return view('contact-messages.index', compact('messages'));
    }

    /**
     * Toggle the resolved status of a message.
     *
     * @param  ContactMessage  $message
     * @return RedirectResponse
     */
    public function toggleResolved(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_resolved' => !$message->is_resolved]);

        return back()->with(
            'success',
            $message->is_resolved ? 'Mensaje marcado como resuelto.' : 'Mensaje reabierto.'
        );
    }
}
