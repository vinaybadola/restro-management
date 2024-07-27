<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $categories = Category::where('name', 'like', "%{$search}%")
                               ->paginate(10); // Adjust items per page as needed
        return response()->json($categories, 200);
    }

    /**
     * Show all categories.
     */
    public function showAllCategories()
    {
        try {
            $categories = Category::all();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Categories not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
            ]);

            $category = Category::findOrFail($id);
            $category->update($validatedData);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Get categories by restaurant.
     */
    public function getCategoriesByRestaurant($restaurantId)
    {
        try {
            $restaurant = Restaurant::findOrFail($restaurantId);
            $categories = $restaurant->categories;
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
    }
}
