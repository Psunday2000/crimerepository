<?php
namespace App\Http\Controllers;

use App\Models\CaseFile;
use App\Models\Category;
use App\Models\Crime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrimeController extends Controller
{
    public function index()
    {
        $crimes = Crime::with('category')->get();
        $categories = Category::all();
        return view('crimes.index', compact('crimes', 'categories'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the role_id of 2
        if ($user->role_id != 2) {
            abort(403, 'Forbidden');
        }

        $request->validate([
            'crime_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'crime_description' => 'required|string',
        ]);

        $crimeData = $request->all();
        $crimeData['date_created'] = now();
        $crimeData['officer_id'] = $user->id;

        Crime::create($crimeData);

        return redirect()->route('crimes.index');
    }

    public function show($id)
    {
        $crime = Crime::with(['evidences', 'suspects', 'category', 'officer'])->findOrFail($id);
        return view('crimes.show', compact('crime'));
    }

    public function destroy(Crime $crime)
    {
        $crime->delete();
        return redirect()->route('crimes.index');
    }
    
    public function makeCase(string $id)
    {
        // Find the crime by ID or fail with a 404 error
        $crime = Crime::findOrFail($id);

        // Check if a case file already exists for this crime ID
        if (CaseFile::where('crime_id', $crime->id)->exists()) {
            return redirect()->route('crimes.index')->with('error', 'A case file already exists for this crime.');
        }

        // Generate a unique case number with the format SPD followed by a 5-digit number
        $prefix = 'SPD';
        do {
            $number = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $caseNumber = $prefix . $number;
        } while (CaseFile::where('case_number', $caseNumber)->exists());

        // Create the case file
        CaseFile::create([
            'crime_id' => $crime->id,
            'case_number' => $caseNumber,
            'case_title' => $crime->crime_title, // Ensure 'crime_title' is a valid field
            'date_created' => now(),
        ]);

        // Redirect to the crime index page with a success message
        return redirect()->route('crimes.index')->with('success', 'Case file created successfully.');
    }

}
