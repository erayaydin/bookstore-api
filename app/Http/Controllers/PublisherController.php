<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherCreateRequest;
use App\Http\Requests\PublisherEditRequest;
use App\Models\Publisher;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('publisher.index', [
            'publishers' => Publisher::query()->latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PublisherCreateRequest $request
     * @return RedirectResponse
     */
    public function store(PublisherCreateRequest $request): RedirectResponse
    {
        Publisher::query()->create($request->only('name'));

        return redirect()->route('publisher.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Publisher $publisher
     * @return Renderable
     */
    public function edit(Publisher $publisher): Renderable
    {
        return view('publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PublisherEditRequest $request
     * @param Publisher $publisher
     * @return RedirectResponse
     */
    public function update(PublisherEditRequest $request, Publisher $publisher): RedirectResponse
    {
        $publisher->update($request->only('name'));

        return redirect()->route('publisher.edit', ['publisher' => $publisher]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Publisher $publisher
     * @return RedirectResponse
     */
    public function destroy(Publisher $publisher): RedirectResponse
    {
        $publisher->delete();

        return redirect()->route('publisher.index');
    }
}
