<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function importForm()
    {
        return view('contacts.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'xml_file' => 'required'
        ]);

        $xmlFile = $request->file('xml_file');
        try{
            $xml = simplexml_load_file($xmlFile);
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Looks like xml file is not correct!');
        }

        $imported = 0;
        $skipped = 0;

        foreach ($xml->contact as $contact) {
            // Check if contact already exists
            $exists = Contact::where('phone', (string)$contact->phone)->exists();
            
            if (!$exists) {
                Contact::create([
                    'name' => (string)$contact->name,
                    'phone' => (string)$contact->phone,
                ]);
                $imported++;
            } else {
                $skipped++;
            }
        }

        return redirect()->route('contacts.index')
            ->with('success', "Imported $imported contacts. Skipped $skipped duplicates.");
    }
}
