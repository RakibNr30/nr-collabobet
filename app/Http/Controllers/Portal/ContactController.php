<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::query()->firstOrCreate([]);

        return view('portal.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $rules = [
            'email' => 'email|max:100',
            'mobile' => 'numeric|max:100',
            'fax' => 'numeric|max:100',
            'address' => 'max:500',
        ];

        $request->validate($rules);

        try {

            DB::beginTransaction();

            $contact = Contact::query()->firstOrCreate([]);

            $contact->update($request->all());

            DB::commit();

            session()->flash('success', 'Contact updated successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }
}
