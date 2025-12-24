<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::where('is_active', true)->get();
        return response()->json(['data' => $games]);
    }

    public function show($slug)
    {
        $game = Game::with([
            'products' => function ($query) {
                $query->where('is_active', true);
            }
        ])->where('slug', $slug)->where('is_active', true)->firstOrFail();

        return response()->json(['data' => $game]);
    }
}
