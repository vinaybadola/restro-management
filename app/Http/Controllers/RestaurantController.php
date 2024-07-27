<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::with('categories')->get();
        return response()->json($restaurants, 200);
    }

    /**
     * Add a category to a restaurant.
     */
    public function addCategory(Request $request, $restaurantId)
    {
        try {
            $restaurant = Restaurant::findOrFail($restaurantId);
            $categoryId = $request->input('category_id');

            // Attach category to restaurant
            $restaurant->categories()->attach($categoryId);

            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
    }

    /**
     * Delete a category from a restaurant.
     */
    public function deleteCategoryFromResturant($restaurantId, $categoryId)
    {
        try {
            $restaurant = Restaurant::findOrFail($restaurantId);

            // Detach the specific category from the restaurant
            $restaurant->categories()->detach($categoryId);

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting category'], 500);
        }
    }
}
