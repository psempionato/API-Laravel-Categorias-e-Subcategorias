<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $sub_categories = Subcategory::all();
        return response()->json($sub_categories, 200);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
                'category_id' => 'required'
            ]);
    
            $sub_category = Subcategory::create($request->all());
    
            return response()->json(['data' => $sub_category], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function show(int $id): JsonResponse
    {
        $sub_category = Subcategory::find($id);
        return response()->json($sub_category, 200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories,name,' . $id . '|max:255',
            ]);
    
            $sub_category = Subcategory::find($id)->update($request->all());
    
            return response()->json($sub_category, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $sub_category = Subcategory::find($id)->delete();

            return response()->json($sub_category, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
}
