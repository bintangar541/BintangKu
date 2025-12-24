<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('created_at', 'desc')->get();
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'platform' => 'nullable|string',
            'popularity_rank' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/images/games');
            $data['thumbnail'] = str_replace('public/', 'storage/', $path);
        }

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('public/images/games');
            $data['banner'] = str_replace('public/', 'storage/', $path);
        }

        Game::create($data);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil ditambahkan!');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'platform' => 'nullable|string',
            'popularity_rank' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($game->thumbnail)
                Storage::delete(str_replace('storage/', 'public/', $game->thumbnail));
            $path = $request->file('thumbnail')->store('public/images/games');
            $data['thumbnail'] = str_replace('public/', 'storage/', $path);
        }

        if ($request->hasFile('banner')) {
            if ($game->banner)
                Storage::delete(str_replace('storage/', 'public/', $game->banner));
            $path = $request->file('banner')->store('public/images/games');
            $data['banner'] = str_replace('public/', 'storage/', $path);
        }

        $game->update($data);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil diupdate!');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game berhasil dihapus!');
    }
}
