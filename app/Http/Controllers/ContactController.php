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

    try {
        Mail::to('akunparam@gmail.com')
        ->send(new ContactMessage($data));


        return redirect()
            ->route('home')
            ->with('success', 'Message sent successfully.');
    } catch (\Throwable $e) {
        return redirect()
            ->route('home')
            ->with('error', 'Failed to send message. Please try again later.');
    }
}

}
