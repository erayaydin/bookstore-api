<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{
    public function index(): Renderable
    {
        $latestUsers = User::query()->orderBy('last_login_at')->take(5)->get();

        $bookSell = 10;
        $bookSellIncrease = 0;
        $suggest = 2;
        $suggestIncrease = 2;
        $totalBook = 3;
        $totalBookIncrease = 3;
        $totalSession = 4;
        $totalSessionIncrease = 4;

        return view('dashboard.index', [
            'latestUsers' => $latestUsers,
            'bookSellIncrease' => $bookSellIncrease,
            'bookSell' => $bookSell,
            'suggestIncrease' => $suggestIncrease,
            'suggest' => $suggest,
            'totalBookIncrease' => $totalBookIncrease,
            'totalBook' => $totalBook,
            'totalSessionIncrease' => $totalSessionIncrease,
            'totalSession' => $totalSession,
        ]);
    }
}
