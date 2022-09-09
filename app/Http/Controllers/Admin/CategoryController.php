<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return response()->json($categories);
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json($category);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'deleted']);
    }
}
