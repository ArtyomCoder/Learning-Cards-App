<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeckController extends Controller
{
    public function index()
    {
        return Auth::user()->decks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $deck = Auth::user()->decks()->create($request->only('name', 'description'));

        return response()->json($deck, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deck = Auth::user()->decks()->findOrFail($id);
        return response()->json($deck);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deck = Auth::user()->decks()->findOrFail($id);
        $deck->update($request->only('name', 'description'));
        return response()->json($deck);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deck = Auth::user()->decks()->findOrFail($id);
        $deck->delete();
        return response()->json(['message' => 'Deck deleted']);
    }
}
