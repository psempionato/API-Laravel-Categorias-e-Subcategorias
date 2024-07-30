<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(): JsonResponse
    {
        $categories = Category::with('subcategories')->get();
        return response()->json($categories, 200);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
            ]);
    
            $category = Category::create($request->all());
    
            return response()->json(['data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function show(int $id): JsonResponse
    {
        $category = Category::with('subcategories')->where('id', $id)->first();
        return response()->json($category, 200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories,name,' . $id . '|max:255',
            ]);
    
            $category = Category::find($id)->update($request->all());
    
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $category = Category::find($id)->delete();

            return response()->json($category, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
}
