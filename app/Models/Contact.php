<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

    public function addContact($user_id, $contact_id){
        $alreadyAdded = $this->where('user_id', $user_id)->where('contact_id', $contact_id)->get();

        if($alreadyAdded->count()){
            return "It's already in your list.";
        }

        $this->create([
            'user_id' => $user_id,
            'contact_id' => $contact_id,
        ]);

        $this->create([
            'user_id' => $contact_id,
            'contact_id' => $user_id,
        ]);

        return 'Contact successfully added to your list.';
    }
}
