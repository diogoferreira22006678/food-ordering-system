<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')->get();
        return view('menu.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'nullable|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        //If the category dont exist we create it
        if (!Category::where('name', $request->category)->exists()){
            Category::create([
                'name' => $request->category
            ]);
        }

        //We query the category so we get the id to establish connection
        $category = Category::where('name', $request->category)->first();

        MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $category->id,
            'image' => $imagePath,
            'options' => $request->options,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu item added successfully.');
    }

    public function destroy(String $menuItemId)
    {
        $menuItem = MenuItem::where('id', $menuItemId)->first();
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }
        $menuItem->delete();
        return back()->with('success', 'Menu item deleted.');
    }
}

