<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryEditRequest;
use App\Http\Requests\CategoryIndexRequest;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(CategoryIndexRequest $request): Renderable
    {
        $parentCategory = null;
        $categories = Category::query();

        if ($request->has('parent')) {
            /** @var Category $parentCategory */
            $parentCategory = Category::query()->find($request->get('parent'));
            $categories = $parentCategory->subs();
        } else {
            $categories = $categories->top();
        }

        $categories = $categories->orderBy('id')->paginate(20);
        return view('category.index', compact('categories', 'parentCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(Request $request): Renderable
    {
        $parentCategory = null;

        if ($request->has('parent'))
        {
            $parentCategory = Category::query()->find($request->get('parent'));
        }

        return view('category.create', compact('parentCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        /** @var Category $category */
        $category = Category::query()->make($request->only('name'));

        if ($request->has('parent_id'))
        {
            $category->parent()->associate($request->get('parent_id'));
        }

        $category->save();

        return redirect()->route('category.index', ['parent' => $request->get('parent_id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Renderable
     */
    public function edit(Request $request, Category $category): Renderable
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryEditRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryEditRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->only('name'));

        return redirect()->route('category.edit', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}
