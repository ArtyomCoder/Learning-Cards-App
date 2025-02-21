<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Deck::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Deck::create($request->validate([
            'title' => 'required', 
            'description' => 'required'
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        return $deck;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deck $deck)
    {
        $deck->update($request->all());
        return $deck;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck)
    {
        $deck->delete();
        return response()->json(null, 204);
    }
}
