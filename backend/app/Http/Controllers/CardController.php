<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($deckId)
    {
        $deck = Deck::findOrFail($deckId);
        return response()->json($deck->cards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $deckId)
    {
        $request->validate([
            'front' => 'required|string',
            'back' => 'required|string',
        ]);

        $deck = Deck::findOrFail($deckId);
        $card = $deck->cards()->create($request->only('front', 'back'));

        return response()->json($card, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($deckId, $cardId)
    {
        $card = Card::where('deck_id', $deckId)->findOrFail($cardId);
        return response()->json($card);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $deckId, $cardId)
    {
        $card = Card::where('deck_id', $deckId)->findOrFail($cardId);
        $card->update($request->only('front', 'back'));
        return response()->json($card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deckId, $cardId)
    {
        $card = Card::where('deck_id', $deckId)->findOrFail($cardId);
        $card->delete();
        return response()->json(['message' => 'Card deleted']);
    }
}
