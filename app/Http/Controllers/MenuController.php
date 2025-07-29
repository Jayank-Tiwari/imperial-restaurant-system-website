<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::with('category');

        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhereHas('category', function ($q2) use ($searchTerm) {
                        $q2->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $menuItems = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.menu.index', compact('menuItems'));
    }


    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $destinationPath = public_path('assets/menu_item');
            $request->file('image')->move($destinationPath, $filename);
            $validated['image'] = 'assets/menu_item/' . $filename;
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu-management')->with('success', 'Menu item added successfully.');
    }


    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.menu.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete previous image if it exists
            if ($menuItem->image && file_exists(public_path($menuItem->image))) {
                unlink(public_path($menuItem->image));
            }
            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $destinationPath = public_path('assets/menu_item');
            $request->file('image')->move($destinationPath, $filename);
            $validated['image'] = 'assets/menu_item/' . $filename;
        }

        $menuItem->update($validated);

        return redirect()->route('admin.menu-management')->with('success', 'Menu item updated successfully.');
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);

        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->delete();

        return redirect()->route('admin.menu-management')->with('success', 'Menu item deleted successfully.');
    }
    public function homeindex()
    {
        $menuItems = MenuItem::with('category')
            ->where('availability', true)
            ->get()
            ->groupBy(fn($item) => strtolower($item->category->name));

        return view('menu', compact('menuItems'));
    }


}
