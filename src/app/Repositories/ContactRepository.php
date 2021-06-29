<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\DocumentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactRepository implements ContactRepositoryInterface
{

    public function search(Request $request)
    {
        $query = Contact::select('contacts.*');

        if ($request->get('keyword')) {
            $search_array = space_array_conversion($request->get('keyword'));
            foreach ($search_array as $search_word) {
                $query->where(function($q) use ($search_word) {
                    $q->where('contacts.content', 'like', "%$search_word%")
                        ->orWhere('contacts.tel', 'like', "%$search_word%")
                        ->orWhere('contacts.email', 'like', "%$search_word%")
                          ->orWhere(DB::raw("CONCAT(contacts.last_name, contacts.first_name)"), 'like', "%$search_word%")
                        ->orWhere(DB::raw("CONCAT(contacts.last_name_kana, contacts.first_name_kana)"), 'like', "%$search_word%");
                });
            }
        }
        if ($request->get('type')) {
            $query = $query->where('contacts.type', $request->get('type'));
        }

        if ($request->get('status')) {
            $query = $query->where('contacts.status', $request->get('status'));
        }

        return $query;
    }

}
