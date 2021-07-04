<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookSectionCreateRequest;
use App\Http\Requests\BookSectionEditRequest;
use App\Models\Book;
use App\Models\BookSection;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Book $book
     * @return Renderable
     */
    public function index(Request $request, Book $book): Renderable
    {
        $parentSection = null;

        if ($request->has('parent')) {
            /** @var BookSection $parentSection */
            $parentSection = BookSection::query()->find($request->get('parent'));
            $sections = $parentSection->subs();
        } else {
            $sections = $book->bookSections()->top();
        }

        return view('book.section.index', [
            'book' => $book,
            'parentSection' => $parentSection,
            'sections' => $sections->orderBy('id')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Book $book
     * @return Renderable
     */
    public function create(Request $request, Book $book): Renderable
    {
        $parentSection = null;

        if ($request->has('parent'))
        {
            $parentSection = BookSection::query()->find($request->get('parent'));
        }

        return view('book.section.create', compact('book', 'parentSection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookSectionCreateRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function store(BookSectionCreateRequest $request, Book $book): RedirectResponse
    {
        /** @var BookSection $bookSection */
        $bookSection = $book->bookSections()->make($request->only('name', 'page'));
        if ($request->has('parent_id'))
        {
            $bookSection->parent()->associate($request->get('parent_id'));
        }
        $bookSection->save();

        return redirect()->route('book.section.index', ['book' => $book, 'parent' => $request->get('parent_id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @param BookSection $bookSection
     * @return Renderable
     */
    public function edit(Book $book, BookSection $bookSection): Renderable
    {
        return view('book.section.edit', compact('book', 'bookSection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookSectionEditRequest $request
     * @param Book $book
     * @param BookSection $bookSection
     * @return RedirectResponse
     */
    public function update(BookSectionEditRequest $request, Book $book, BookSection $bookSection): RedirectResponse
    {
        $bookSection->update($request->only('name', 'page'));

        return redirect()->route('book.section.edit', ['book' => $book, 'section' => $bookSection]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @param BookSection $bookSection
     * @return RedirectResponse
     */
    public function destroy(Book $book, BookSection $bookSection): RedirectResponse
    {
        $bookSection->delete();

        return redirect()->route('book.section.index', ['book' => $book]);
    }
}
