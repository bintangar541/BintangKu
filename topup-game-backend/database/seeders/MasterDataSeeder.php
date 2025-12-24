<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Games
        $gamesData = [
            ['name' => 'Mobile Legends', 'slug' => 'mobile-legends', 'category' => 'mobile', 'thumbnail' => 'images/games/ml.jpg', 'banner' => 'images/games/ml.jpg'],
            ['name' => 'Free Fire', 'slug' => 'free-fire', 'category' => 'mobile', 'thumbnail' => 'images/games/ff.jpg', 'banner' => 'images/games/ff.jpg'],
            ['name' => 'Genshin Impact', 'slug' => 'genshin-impact', 'category' => 'mobile', 'thumbnail' => 'images/games/genshin.jpg', 'banner' => 'images/games/genshin.jpg'],
            ['name' => 'Valorant', 'slug' => 'valorant', 'category' => 'pc', 'thumbnail' => 'images/games/valo.jpg', 'banner' => 'images/games/valo.jpg'],
            ['name' => 'PUBG Mobile', 'slug' => 'pubg-mobile', 'category' => 'mobile', 'thumbnail' => 'images/games/pubg.jpg', 'banner' => 'images/games/pubg.jpg'],
            ['name' => 'Roblox', 'slug' => 'roblox', 'category' => 'voucher', 'thumbnail' => 'images/games/roblox.png', 'banner' => 'images/games/roblox.png'],
            ['name' => 'Call of Duty Mobile', 'slug' => 'cod-mobile', 'category' => 'mobile', 'thumbnail' => 'images/games/codm.jpg', 'banner' => 'images/games/codm.jpg'],
            ['name' => 'Steam Wallet', 'slug' => 'steam-wallet', 'category' => 'voucher', 'thumbnail' => 'images/games/steam.jpg', 'banner' => 'images/games/steam.jpg'],
            ['name' => 'Honor of Kings', 'slug' => 'honor-of-kings', 'category' => 'mobile', 'thumbnail' => 'images/games/hok.png', 'banner' => 'images/games/hok.png'],
            ['name' => 'Honkai: Star Rail', 'slug' => 'honkai-star-rail', 'category' => 'mobile', 'thumbnail' => 'images/games/honkai.jpg', 'banner' => 'images/games/honkai.jpg'],
            ['name' => 'Point Blank', 'slug' => 'point-blank', 'category' => 'pc', 'thumbnail' => 'images/games/pb.jpg', 'banner' => 'images/games/pb.jpg'],
            ['name' => 'Ragnarok Origin', 'slug' => 'ragnarok-origin', 'category' => 'mobile', 'thumbnail' => 'images/games/ragnarok.jpg', 'banner' => 'images/games/ragnarok.jpg'],
            ['name' => 'Clash of Clans', 'slug' => 'clash-of-clans', 'category' => 'mobile', 'thumbnail' => 'images/games/coc.jpg', 'banner' => 'images/games/coc.jpg'],
            ['name' => 'Wild Rift', 'slug' => 'wild-rift', 'category' => 'mobile', 'thumbnail' => 'images/games/l.png', 'banner' => 'images/games/l.png'],
            ['name' => 'Minecraft', 'slug' => 'minecraft', 'category' => 'voucher', 'thumbnail' => 'images/games/min.png', 'banner' => 'images/games/min.png'],
        ];

        foreach ($gamesData as $data) {
            $game = Game::updateOrCreate(['slug' => $data['slug']], array_merge($data, ['is_active' => true]));

            if ($game->slug === 'valorant') {
                $valorantProducts = [
                    ['name' => '475 Points', 'price' => 53000],
                    ['name' => '1000 Points', 'price' => 105000],
                    ['name' => '1475 Points', 'price' => 158000],
                    ['name' => '2050 Points', 'price' => 211000],
                    ['name' => '2525 Points', 'price' => 264000],
                    ['name' => '3050 Points', 'price' => 316000],
                    ['name' => '3650 Points', 'price' => 366000],
                    ['name' => '4125 Points', 'price' => 419000],
                    ['name' => '5350 Points', 'price' => 526000],
                    ['name' => '11000 Points', 'price' => 1035000],
                    ['name' => '20000 Points', 'price' => 1927000],
                ];
                foreach ($valorantProducts as $p) {
                    Product::updateOrCreate(
                        ['game_id' => $game->id, 'sku' => 'VALO-' . str_replace(' ', '', $p['name'])],
                        ['name' => $p['name'], 'price_modal' => $p['price'] * 0.9, 'price_sell' => $p['price'], 'stock' => 100, 'is_active' => true]
                    );
                }
            } elseif ($game->slug === 'steam-wallet') {
                $steamProducts = [
                    ['name' => 'Steam Wallet IDR 12.000', 'price' => 12000],
                    ['name' => 'Steam Wallet IDR 45.000', 'price' => 45000],
                    ['name' => 'Steam Wallet IDR 60.000', 'price' => 60000],
                    ['name' => 'Steam Wallet IDR 90.000', 'price' => 90000],
                    ['name' => 'Steam Wallet IDR 120.000', 'price' => 120000],
                    ['name' => 'Steam Wallet IDR 250.000', 'price' => 250000],
                    ['name' => 'Steam Wallet IDR 400.000', 'price' => 400000],
                ];
                foreach ($steamProducts as $p) {
                    Product::updateOrCreate(
                        ['game_id' => $game->id, 'sku' => 'STEAM-' . str_replace(' ', '', $p['name'])],
                        ['name' => $p['name'], 'price_modal' => $p['price'] * 0.9, 'price_sell' => $p['price'], 'stock' => 100, 'is_active' => true]
                    );
                }
            } else {
                // Default products for other games
                $currency = 'Diamonds';
                switch ($game->slug) {
                    case 'pubg-mobile':
                        $currency = 'UC';
                        break;
                    case 'roblox':
                        $currency = 'Robux';
                        break;
                    case 'steam-wallet':
                        $currency = 'Wallet IDR';
                        break;
                    default:
                        $currency = 'Diamonds';
                }

                $denoms = [50, 100, 250, 500, 1000];
                foreach ($denoms as $d) {
                    Product::updateOrCreate(
                        ['game_id' => $game->id, 'sku' => strtoupper($game->slug) . '-' . $d],
                        [
                            'name' => "$d $currency",
                            'price_modal' => $d * 200,
                            'price_sell' => $d * 220,
                            'stock' => 100,
                            'is_active' => true
                        ]
                    );
                }
            }
        }

        // 2. Create Payment Methods
        $payments = [
            ['code' => 'bca_va', 'name' => 'BCA Virtual Account', 'flat' => 2500, 'percent' => 0],
            ['code' => 'mandiri_va', 'name' => 'Mandiri Virtual Account', 'flat' => 2500, 'percent' => 0],
            ['code' => 'bri_va', 'name' => 'BRI Virtual Account', 'flat' => 2500, 'percent' => 0],
            ['code' => 'bni_va', 'name' => 'BNI Virtual Account', 'flat' => 2500, 'percent' => 0],
            ['code' => 'gopay', 'name' => 'GoPay', 'flat' => 2000, 'percent' => 0],
            ['code' => 'dana', 'name' => 'DANA', 'flat' => 2000, 'percent' => 0],
            ['code' => 'ovo', 'name' => 'OVO', 'flat' => 2000, 'percent' => 0],
            ['code' => 'shopeepay', 'name' => 'ShopeePay', 'flat' => 2000, 'percent' => 0],
            ['code' => 'qris', 'name' => 'QRIS (All E-Wallet)', 'flat' => 1000, 'percent' => 0],
            ['code' => 'alfamart', 'name' => 'Alfamart', 'flat' => 5000, 'percent' => 0],
            ['code' => 'indomaret', 'name' => 'Indomaret', 'flat' => 5000, 'percent' => 0],
        ];

        foreach ($payments as $pay) {
            PaymentMethod::updateOrCreate(
                ['code' => $pay['code']],
                [
                    'name' => $pay['name'],
                    'admin_fee_flat' => $pay['flat'],
                    'admin_fee_percent' => $pay['percent'],
                    'is_active' => true
                ]
            );
        }

        // 3. Set Popularity Rank for Top 5
        $top5Slugs = [
            'mobile-legends' => 100,
            'free-fire' => 95,
            'valorant' => 90,
            'roblox' => 85,
            'pubg-mobile' => 80
        ];

        foreach ($top5Slugs as $slug => $rank) {
            Game::where('slug', $slug)->update(['popularity_rank' => $rank]);
        }
    }
}
