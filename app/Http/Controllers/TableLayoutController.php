<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableLayout;
use App\Events\TableUpdated;

class TableLayoutController extends Controller
{
    public function index()
    {
        $tables = TableLayout::all();
        return view('tables.index', compact('tables'));
    }

    public function create()
    {
        return view('tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_name' => 'required|string|max:255',
        ]);

        // Set default position if not provided
        $validated['x_position'] = 50;
        $validated['y_position'] = 50;

        TableLayout::create($validated);

        return redirect()->route('tables.index')->with('success', 'Table added successfully.');
    }

    public function edit(TableLayout $table)
    {
        return view('tables.edit', compact('table'));
    }

    public function update(Request $request, TableLayout $table)
    {
        $validated = $request->validate([
            'table_name' => 'required|string|max:255',
        ]);
    
        $table->update($validated);
    
        broadcast(new TableUpdated($table))->toOthers(); // Broadcast the update event
    
        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    public function destroy(TableLayout $table)
    {
        $table->delete();

        return redirect()->route('tables.index')->with('success', 'Table removed.');
    }
    
    public function updatePosition(Request $request)
    {
        $table = TableLayout::findOrFail($request->id);
        $table->update([
            'x_position' => $request->x_position,
            'y_position' => $request->y_position
        ]);

        return response()->json(['message' => 'Table position updated successfully']);
    }
}
