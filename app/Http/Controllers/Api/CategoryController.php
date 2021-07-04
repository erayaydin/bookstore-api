<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::query()->top()->with('subs')->paginate(20));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
}
