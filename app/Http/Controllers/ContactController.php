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
            'phone_number' => 'required|numeric|min_digits:11|max_digits:11',
            'subject' => 'required',
            'message' => 'required|min:3'
        ]);

        try {
            Mail::to(config('mail.to.address'), config('mail.to.name'))->send(new ContactMe($validated));
            return to_route('contact');
        } catch (\Exception $e) {
            return to_route('contact')->withErrors(['failed' => "<b>Error: </b>" . $e->getMessage() . "<br><br>Please try again later."]);
        }
    }
}
