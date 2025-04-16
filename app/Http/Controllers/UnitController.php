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
        $unit = Unit::find($id);
        if (!$unit) {
            return response()->json(['success' => 'not found', 'message' => 'unit not found']);
        }
        return response()->json($unit);
    }

    // Update the specified unit in storage
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units',
        ]);

        $unit->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => 'unit updated',
            'message' => 'Unit Updated Successfully',
        ]);
    }

    // Remove the specified unit from storage
    public function destroy($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'success' => 'unit missing', 
                'message' => 'Unit not found'], 404);
        }

        return response()->json([
            'success' => 'deleted',
            'message' => 'Unit Deleted Successfully',
            'unit' => $unit,
        ]);
    }
}