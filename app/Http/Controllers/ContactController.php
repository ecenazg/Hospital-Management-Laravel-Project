<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',

        ]);

        $contact = Contact::create($request->only('name', 'email', 'message'));


        return Inertia::render('Contact');
    }

    public function store(StoreContactRequest $request)
    {
        $validatedData = $request->validated();

        Contact::create($validatedData);

        return response()->json(['message' => 'Message sent successfully.']);
    }
}
