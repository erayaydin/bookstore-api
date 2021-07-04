<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorEditRequest;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookEditRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('book.index', [
            'books' => Book::query()->latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        $publishers = Publisher::query()->orderBy('name')->pluck('name', 'id');
        $authors = Author::query()->orderBy('name')->pluck('name', 'id');
        return view('book.create', compact('publishers', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BookCreateRequest $request): RedirectResponse
    {
        /** @var Book $book */
        $book = Book::query()->make($request->only('name', 'isbn', 'price'));
        if ($request->has('published_at')) {
            $book->published_at = Carbon::createFromFormat("d.m.Y", $request->get('published_at'));
        }
        if ($request->has('publisher_id')) {
            $book->publisher()->associate($request->get('publisher_id'));
        }
        $book->save();
        if ($request->has('authors')) {
            $book->authors()->attach($request->get('authors'));
        }

        try {
            $book->addMedia($request->file('pdf'))->toMediaCollection('pdf');
            $book->addMedia($request->file('image'))->toMediaCollection('image');
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            dd($e);
        }

        return redirect()->route('book.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Renderable
     */
    public function edit(Book $book): Renderable
    {
        $publishers = Publisher::query()->orderBy('name')->pluck('name', 'id');
        $authors = Author::query()->orderBy('name')->pluck('name', 'id');
        return view('book.edit', compact('book', 'publishers', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookEditRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(BookEditRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->only('name', 'isbn', 'price'));
        if ($request->has('published_at')) {
            $book->published_at = Carbon::createFromFormat("d.m.Y", $request->get('published_at'));
        }
        if ($request->has('publisher_id')) {
            $book->publisher()->associate($request->get('publisher_id'));
        }
        $book->save();
        if ($request->has('authors')) {
            $book->authors()->sync($request->get('authors'));
        }

        if ($request->hasFile('pdf')) {
            try {
                $book->addMedia($request->file('pdf'))->toMediaCollection('pdf');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                dd($e);
            }
        }

        if ($request->hasFile('image')) {
            try {
                $book->addMedia($request->file('image'))->toMediaCollection('image');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                dd($e);
            }
        }

        return redirect()->route('book.edit', ['book' => $book]);
    }

    public function download(Book $book): BinaryFileResponse
    {
        if ($book->getFirstMedia('pdf') === null)
        {
            abort(500);
        }

        return response()->download($book->getFirstMediaPath('pdf'), config('app.name')."_".$book->name.".".$book->getFirstMedia('pdf')->getExtensionAttribute());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('book.index');
    }
}
