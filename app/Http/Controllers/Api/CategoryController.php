<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return response()->json([
            'categories' => $category
        ]);
    }



    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'category added',
            'category' => $category,
        ], 200);

    }

    public function update(CategoryRequest $request, Category $category)
    {
      $category->update($request->all());

        return response()->json([
            'message' => 'category updated',
            'category' => $category,
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'category deleted',
            'category' => $category,
        ]);

    }
}
