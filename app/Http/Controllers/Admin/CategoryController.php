<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{

    public function index()
    {
        $categories  = Category::orderBy('name')->get();

        return response()->json($categories);
    }
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json($category);
    }
    public function update(CategoryUpdateRequest $request,Category $category)
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
