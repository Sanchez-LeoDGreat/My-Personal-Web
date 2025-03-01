<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contact');
    }

    public function send_email(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required|min:3'
        ]);

        try {
            Mail::to(config('mail.to.address'), config('mail.to.name'))->send(new ContactMe($validated));
            return to_route('contact');
        } catch (\Exception $e) {
            return to_route('contact')->withErrors(['failed' => 'Failed to send email.<br>Error: ' . $e->getMessage() . '<br>Please try again later.']);
        }
    }
}
