<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::to(config('mail.from.address'))
            ->send(new ContactMessage($data));

        return redirect()
            ->route('home')
            ->with('success', 'Thank you. I will get back to you as soon as possible.');
    }
}
