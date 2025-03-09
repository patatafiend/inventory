<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    // Display a listing of the units
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    // Show the form for creating a new unit
    public function create()
    {
        return view('units.create');
    }

    // Store a newly created unit in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all([
            'name' => 'required|string|max:255|unique:units',
        ]));

        if($validator->fails()){
            $errors[] = 'invalid input';
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $unit = Unit::create($request->all());

        $html = view('units.add-unit', compact('unit'))->render();

        return response()-> json([
            'success' => 'added',
            'message' => 'Unit added',
            'html' => $html,
        ]);
    }

    // Show the form for editing the specified unit
    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    // Update the specified unit in storage
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $unit->update([
            'name' => $request->name,
        ]);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    // Remove the specified unit from storage
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}