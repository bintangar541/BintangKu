<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Game;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('game')->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $games = Game::all();
        return view('admin.products.create', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'price_modal' => 'required|numeric',
            'price_sell' => 'required|numeric',
            'is_active' => 'nullable',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $games = Game::all();
        return view('admin.products.edit', compact('product', 'games'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price_modal' => 'required|numeric',
            'price_sell' => 'required|numeric',
            'is_active' => 'nullable',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
