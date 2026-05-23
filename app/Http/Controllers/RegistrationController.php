<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::all();
        return view('partials.registrations', compact('registrations'));
    }

    public function create()
    {
        return view('partials.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'               => 'required|string|max:255',
            'age'                     => 'required|integer|min:1',
            'gender'                  => 'required|string',
            'phone'                   => 'required|string|max:11',
            'email'                   => 'required|email|unique:registrations,email',
            'address'                 => 'required|string',
            'marathon_category'       => 'required|string',
            'emergency_contact_name'  => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:11',
            'experience_level'        => 'required|string',
            'shirt_size'              => 'required|string',
        ]);

        $validated['registration_date'] = now()->toDateString();

        Registration::create($validated);

        return redirect()->route('partials.index')->with('success', 'Registration successful!');
    }

    public function edit($id)
    {
        $registration = Registration::findOrFail($id);
        return view('partials.editregister', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'full_name'               => 'required|string|max:255',
            'age'                     => 'required|integer|min:1',
            'gender'                  => 'required|string',
            'phone'                   => 'required|string|max:11',
            'email'                   => 'required|email|unique:registrations,email,' . $id,
            'address'                 => 'required|string',
            'marathon_category'       => 'required|string',
            'emergency_contact_name'  => 'required|string|max:255',
            'registration_date'       => 'required|date',
            'emergency_contact_phone' => 'required|string|max:11',
            'experience_level'        => 'required|string',
            'shirt_size'              => 'required|string',
        ]);

        

        $registration->update($validated);

        return redirect()->route('partials.index')->with('success', 'Runner updated successfully!');
    }

    public function destroy($id)
    {
        Registration::findOrFail($id)->delete();
        return redirect()->route('partials.index')->with('success', 'Runner deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $registrations = Registration::where('full_name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('marathon_category', 'like', "%$query%")
            ->orWhere('experience_level', 'like', "%$query%")
            ->orWhere('shirt_size', 'like', "%$query%")
            ->orWhere('gender', 'like', "%$query%")
            ->get();

        return view('partials.registrations', compact('registrations', 'query'));
    }
}