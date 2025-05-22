<?php

namespace App\Http\Controllers;

use App\DataTables\ContactsDataTable;
use App\Models\Contact;
use Illuminate\Http\Request;
use SimpleXMLElement;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::query();

            return DataTables::of($contacts)
                ->addColumn('action', function ($contact) {
                    return '
                        <a href="' . route('contacts.show', $contact->id) . '" class="btn btn-sm btn-info">View</a>
                        <a href="' . route('contacts.edit', $contact->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('contacts.destroy', $contact->id) . '" method="POST" style="display:inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action']) // important to render HTML
                ->make(true);
        }

        return view('contacts.index'); // Blade view where your DataTable JS lives
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+90 \d{3} \d{7}$/',
        ], [
            'phone.regex' => 'Phone must be in the format: +90 XXX XXXXXXX'
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+90 \d{3} \d{7}$/',
        ], [
            'phone.regex' => 'Phone must be in the format: +90 XXX XXXXXXX'
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully');
    }
}