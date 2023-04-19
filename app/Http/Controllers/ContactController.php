<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // default 
    public function index(Request $request)
    {
        $contacts = [];
        $result = Contact::where('user_id', auth()->id())->get();
        foreach($result as $contact) {
            $contacts[] = User::find($contact->contact_id);
        }
        // dd($contacts);
        return response()->json([
            'data' => $contacts
        ], 200);
    }

    public function new($id)
    {
        $contact = new Contact();
        $message = $contact->addContact(auth()->id(), $id);
        
        return response()->json([
            'message' => $message
        ], 201);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required'
        ]);

        $query = $request->input('query');
        $contact = User::where('name', 'LIKE', "%$query%")->where('id', '<>', auth()->id())->get();
        return response()->json([
            'data' => $contact
        ], 201);
    }
}
