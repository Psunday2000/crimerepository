<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidences = Evidence::latest()->get();
        return view('evidences.index', compact('evidences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Log::info('Received store request:', $request->all());

    // Validate the request
    try {
        $validatedData = $request->validate([
            'crime_id' => 'required|exists:crimes,id',
            'evidence_type' => 'required|string|max:255',
            'evidence_name' => 'required|string|max:255',
            'evidence_content' => 'required|file|max:2048000000',
        ]);
        Log::info('Validation passed:', $validatedData);
    } catch (\Exception $e) {
        Log::error('Validation failed:', ['error' => $e->getMessage()]);
        return back()->withErrors(['validation' => 'Validation failed'])->withInput();
    }

    // Check if the file is present and store it
    try {
        if ($request->hasFile('evidence_content')) {
            $evidenceContentPath = $request->file('evidence_content')->store('evidences', 'public');
            Log::info('Evidence content stored at path: ' . $evidenceContentPath);
        } else {
            Log::error('Evidence content file not found in request');
            return back()->withErrors(['evidence_content' => 'Evidence content file not found'])->withInput();
        }
    } catch (\Exception $e) {
        Log::error('File storage failed:', ['error' => $e->getMessage()]);
        return back()->withErrors(['file_storage' => 'Failed to store file'])->withInput();
    }

    // Create the evidence
    try {
        $evidence = Evidence::create([
            'crime_id' => $request->crime_id,
            'evidence_type' => $request->evidence_type,
            'evidence_name' => $request->evidence_name,
            'evidence_content' => $evidenceContentPath,
            'date_collected' => now(),
        ]);

        if ($evidence) {
            Log::info('Evidence saved successfully:', $evidence->toArray());
        } else {
            Log::error('Failed to save evidence');
            return back()->withErrors(['general' => 'Failed to add evidence'])->withInput();
        }

        return redirect()->route('crimes.show', $request->crime_id);
    } catch (\Exception $e) {
        Log::error('Exception caught during save:', ['error' => $e->getMessage()]);
        return back()->withErrors(['general' => 'Failed to add evidence'])->withInput();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the evidence record or fail with a 404 error
        $evidence = Evidence::findOrFail($id);

        // Delete the associated file from storage
        if (Storage::disk('public')->exists($evidence->evidence_content)) {
            Storage::disk('public')->delete($evidence->evidence_content);
        }

        // Delete the evidence record from the database
        $evidence->delete();

        // Redirect back with a success message (optional)
        return redirect()->back()->with('success', 'Evidence deleted successfully.');
    }

}
