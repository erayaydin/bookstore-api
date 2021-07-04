<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        return PublisherResource::collection(Publisher::query()->with('books')->latest()->paginate(20));
    }

    public function show(Publisher $publisher)
    {
        return new PublisherResource($publisher);
    }
}
