<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::query()->latest()->with(['authors', 'publisher'])->with('bookSections', function(HasMany $builder) {
            return $builder->whereNull('parent_id');
        })->paginate(20));
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function getFile(Book $book)
    {
        if (!$book->getFirstMedia('pdf')) {
            abort(403);
        }

        return response()->download($book->getFirstMediaPath('pdf'), config('app.name')."_".$book->name.".".$book->getFirstMedia('pdf')->getExtensionAttribute());
    }
}
