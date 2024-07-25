<?php

namespace App\Http\Controllers;

use App\Models\CaseFile;
use App\Models\Evidence;
use App\Models\Suspect;
use Illuminate\Http\Request;

class CaseFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casefiles = CaseFile::latest()->get();
        return view('casefiles.index', compact('casefiles'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $casefile = CaseFile::findorFail($id);

        $suspect_count = Suspect::where('crime_id', $casefile->crime_id)->count();
        $evidence_count = Evidence::where('crime_id', $casefile->crime_id)->count();

        return view('casefiles.show', compact('casefile', 'suspect_count', 'evidence_count'));
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
        //
    }
}
