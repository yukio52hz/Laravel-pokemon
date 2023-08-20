<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FavoritePokemon;

class FavoritePokemonController extends Controller
{
    //
    public function getAllFavoriteList()
    {
        $user = auth()->user();
        $favorites = $user->favoritePokemon;

        return response()->json($favorites);
    }

    public function addToFavorites(Request $request, $pokemonId)
    {
        $user = auth()->user(); //  usuario autenticado

        $existingFavorite = FavoritePokemon::where('user_id', $user->id)
            ->where('pokemon_id', $pokemonId)
            ->first();
        if (!$existingFavorite) {
            FavoritePokemon::create([
                'user_id' => $user->id,
                'pokemon_id' => $pokemonId,
            ]);
            return response()->json(['message' => 'Pokémon added to favorites']);
        } else {
            $existingFavorite->delete();
            return response()->json(['message' => 'Pokémon removed from favorites']);
        }
    }
}
