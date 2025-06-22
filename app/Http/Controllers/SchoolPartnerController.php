<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolPartner;
use App\Exports\SchoolPartnersExport;
use Maatwebsite\Excel\Facades\Excel;

class SchoolPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $search = $request->input('search');

        $partners = SchoolPartner::when($search, function ($query, $search) {
            $query->where('school_name', 'like', "%$search%")
                ->orWhere('contact_person', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // keeps search term during pagination

    return view('school_partners.index', compact('partners', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school_partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'school_name' => 'required|max:255',
            'contact_person' => 'required|max:255',
            'email' => 'required|email|unique:school_partners,email',
            'num_students' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        SchoolPartner::create($validated);
        return redirect()->route('school-partners.index')->with('success', 'School Partner added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schoolPartner = \App\Models\SchoolPartner::findOrFail($id);
        return view('school_partners.show', compact('schoolPartner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schoolPartner = SchoolPartner::findOrFail($id);
        return view('school_partners.edit', compact('schoolPartner'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $schoolPartner = SchoolPartner::findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'required|max:255',
            'contact_person' => 'required|max:255',
            'email' => 'required|email|unique:school_partners,email,' . $schoolPartner->id,
            'num_students' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $schoolPartner->update($validated);
        return redirect()->route('school-partners.index')->with('success', 'School Partner updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schoolPartner = SchoolPartner::findOrFail($id);
        $schoolPartner->delete();
        return redirect()->route('school-partners.index')->with('success', 'School Partner deleted.');
    }

    public function export()
    {
        return Excel::download(new SchoolPartnersExport, 'school_partners.xlsx');
    }
}
