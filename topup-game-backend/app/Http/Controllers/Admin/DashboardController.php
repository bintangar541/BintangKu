<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Dasar
        $totalGames = Game::count();
        $totalProducts = Product::count();

        // Contoh data transaksi (asumsi ada tabel transactions)
        $totalTransactions = Schema::hasTable('transactions') ? DB::table('transactions')->count() : 0;

        // Game Populer berdasarkan rank
        $popularGames = Game::orderBy('popularity_rank', 'desc')->take(5)->get();

        // Data Penjualan (Pie Chart) - Berdasarkan Transaksi "paid"
        $salesByGame = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('games', 'transaction_details.game_id', '=', 'games.id')
            ->where('transactions.status', 'paid')
            ->select('games.name', DB::raw('count(transaction_details.id) as total_sales'))
            ->groupBy('games.id', 'games.name')
            ->get();

        $salesChart = [
            'labels' => $salesByGame->pluck('name')->toArray(),
            'data' => $salesByGame->pluck('total_sales')->toArray(),
            'colors' => ['#f39c12', '#e74c3c', '#00a65a', '#3c8dbc', '#d2d6de', '#9b59b6', '#34495e']
        ];

        return view('admin.dashboard', compact(
            'totalGames',
            'totalProducts',
            'totalTransactions',
            'popularGames',
            'salesChart'
        ));
    }
}
