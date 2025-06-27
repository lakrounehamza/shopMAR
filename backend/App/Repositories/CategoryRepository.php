<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    public function getCategoryById($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function createCategory(CreateCategory $data)
    {
        $category = Category::create([
            'name' => $data->name,
        ]);
        return response()->json([
            'success' => true,
            'data' => $category
        ], 201);
    }
    public function updateCategory($id, UpdateCategory $data)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $data->name,
        ]);
        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }

    public function getCategoryByName($name)
    {
        $category = Category::where('name', $name)->first();
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function getCategoriesWithProducts()
    {
        $categories = Category::with('products')->get();
        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }
}
