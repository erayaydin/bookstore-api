<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorEditRequest;
use App\Http\Requests\PublisherCreateRequest;
use App\Http\Requests\PublisherEditRequest;
use App\Models\Author;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('author.index', [
            'authors' => Author::query()->latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorCreateRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorCreateRequest $request): RedirectResponse
    {
        $author = Author::query()->create($request->only('name'));

        if ($request->hasFile('image')) {
            try {
                $author->addMedia($request->file('image'))->toMediaCollection('image');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                dd($e);
            }
        }

        return redirect()->route('author.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return Renderable
     */
    public function edit(Author $author): Renderable
    {
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorEditRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(AuthorEditRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->only('name'));

        if ($request->hasFile('image')) {
            try {
                $author->addMedia($request->file('image'))->toMediaCollection('image');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                dd($e);
            }
        }

        return redirect()->route('author.edit', ['author' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return RedirectResponse
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('author.index');
    }
}
