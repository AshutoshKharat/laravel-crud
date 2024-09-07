<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\DataTables;

use App\Models\Form;
use App\Models\City;
use App\Models\State;
use App\Models\Country;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        $countries = Country::all(); // Fetch from DB
        return view('forms.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'terms' => 'accepted',
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Handle file upload
        $filename = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_pictures'), $filename);
        }

        Form::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'country_id' => $request->input('country'),
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'terms' => $request->input('terms'),
            'gender' => $request->input('gender'),
            'birthdate' => $request->input('birthdate'),
            'file' => $filename,
        ]);

        return redirect()->route('forms.index')->with('success', 'Form submitted successfully!');
    }

    public function getFormsData()
    {
        $forms = Form::select(['id', 'name', 'email']);

        return DataTables::of($forms)
            ->addColumn('actions', function ($form) {
                return '<a href="' . route('forms.edit', $form->id) . '" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" data-id="' . $form->id . '" class="btn btn-sm btn-danger delete-btn">Delete</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json(['states' => $states]);
    }

    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json(['cities' => $cities]);
    }

    public function edit($id)
    {
        $form = Form::findOrFail($id);
        $countries = Country::all(); // Fetch all countries
        return view('forms.edit', compact('form', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'terms' => 'accepted',
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $form = Form::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete old file if it exists
            if ($form->file) {
                $oldFilePath = public_path('profile_pictures/' . $form->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Store new file
            $file = $request->file('file');
            $filePath = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_pictures'), $filePath);
            $form->file = $filePath;
        }

        $form->name = $request->input('name');
        $form->email = $request->input('email');
        $form->country_id = $request->input('country');
        $form->state_id = $request->input('state');
        $form->city_id = $request->input('city');
        $form->terms = $request->has('terms') ? 'accepted' : 'not accepted';
        $form->gender = $request->input('gender');
        $form->birthdate = $request->input('birthdate');
        $form->save();

        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }

    public function destroy($id)
    {
        $form = Form::findOrFail($id);

        // Check if the file exists and delete it
        if ($form->file_path) {
            Storage::disk('public')->delete($form->file_path);
        }

        // Delete the form record
        $form->delete();

        // Return a JSON response for AJAX
        return response()->json(['message' => 'Form deleted successfully!']);
    }
}
