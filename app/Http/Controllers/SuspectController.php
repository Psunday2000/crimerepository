<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Crime;
use App\Models\Suspect;
use Illuminate\Support\Facades\Storage;

class SuspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        if (Auth::user()->role_id != 2) {
            Log::warning('Unauthorized access attempt by user ID ' . Auth::id());
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validatedData = $request->validate([
            'crime_id' => 'required|exists:crimes,id',
            'suspect_name' => 'required|string|max:255',
            'mugshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'height' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        Log::info('Validation passed:', $validatedData);

        try {
            if ($request->hasFile('mugshot')) {
                $mugshotPath = $request->file('mugshot')->store('public/suspects/mugshots');
                Log::info('Mugshot stored at path: ' . $mugshotPath);
            } else {
                Log::error('Mugshot file not found in request');
                return back()->withErrors(['mugshot' => 'Mugshot file not found'])->withInput();
            }

            $suspect = new Suspect();
            $suspect->crime_id = $request->crime_id;
            $suspect->suspect_name = $request->suspect_name;
            $suspect->mugshot = $mugshotPath;
            $suspect->height = $request->height;
            $suspect->address = $request->address;
            $suspect->date_of_birth = $request->date_of_birth;
            $suspect->date_created = now();
            $suspect->save();

            Log::info('Suspect saved successfully:', $suspect->toArray());

            return redirect()->route('crimes.show', $request->crime_id);
        } catch (\Exception $e) {
            Log::error('Exception caught:', ['error' => $e->getMessage()]);
            return back()->withErrors(['general' => 'Failed to add suspect'])->withInput();
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
        // Find the suspect by ID or fail with a 404 error
        $suspect = Suspect::findOrFail($id);

        // Delete the associated mugshot file from storage if it exists
        if ($suspect->mugshot && Storage::disk('public')->exists($suspect->mugshot)) {
            Storage::disk('public')->delete($suspect->mugshot);
        }

        // Delete the suspect record from the database
        $suspect->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Suspect deleted successfully.');
    }
}
