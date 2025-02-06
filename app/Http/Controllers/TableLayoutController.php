<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableLayout;
use App\Events\TableUpdated;
use App\Events\TableCreated;
use App\Events\TableDeleted;

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
        //Validate form 
        $validated = $request->validate([
            'table_name' => 'required|string|max:255',
            'seats' => 'required|integer',
        ]);
    
        // Set default position if not provided
        $validated['x_position'] = 50;
        $validated['y_position'] = 50;
    
        $table = TableLayout::create($validated);
    
        broadcast(new TableCreated($table))->toOthers(); // Broadcast event
    
        return redirect()->route('tables.index')->with('success', 'Table added successfully.');
    }
    

    public function edit(TableLayout $table)
    {
        return view('tables.create', compact('table'));
    }

    public function update(Request $request, TableLayout $table)
    {
        $validated = $request->validate([
            'table_name' => 'required|string|max:255',
            'seats' => 'required|integer',
        ]);
    
        $table->update($validated);
    
        broadcast(new TableUpdated($table))->toOthers(); // Broadcast event
    
        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    public function destroy(TableLayout $table)
    {
        $tableId = $table->table_id;
        $table->delete();
    
        broadcast(new TableDeleted($tableId))->toOthers(); // Broadcast event
    
        return redirect()->route('tables.index')->with('success', 'Table removed.');
    }
    
    
    public function updatePosition(Request $request)
    {
        $table = TableLayout::findOrFail($request->id);
        $table->update([
            'x_position' => $request->x_position,
            'y_position' => $request->y_position
        ]);
    
        broadcast(new TableUpdated($table))->toOthers(); // Broadcast event
    
        return response()->json(['message' => 'Table position updated successfully']);
    }
    
}
