<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch total counts for stats
        $totalUsers = User::count();
        $totalSales = Sale::sum('total_amount');  // Assuming 'total_amount' is the column storing the total sales amount
        $totalProducts = Product::count();

        // Fetch data for the charts
        $userCounts = User::selectRaw('DATE(created_at) as date, count(*) as count')
                          ->groupBy('date')
                          ->orderBy('date', 'asc')
                          ->get();

        $saleCounts = Sale::selectRaw('DATE(created_at) as date, sum(total_amount) as total_sales')
                          ->groupBy('date')
                          ->orderBy('date', 'asc')
                          ->get();

        $userLabels = $userCounts->pluck('date')->toArray();
        $userData = $userCounts->pluck('count')->toArray();

        $saleLabels = $saleCounts->pluck('date')->toArray();
        $saleData = $saleCounts->pluck('total_sales')->toArray();

        // Pass all data to the view
        return view('home', [
            'totalUsers' => $totalUsers,
            'totalSales' => $totalSales,
            'totalProducts' => $totalProducts,
            'users_labels' => $userLabels,
            'users_data' => $userData,
            'sales_labels' => $saleLabels,
            'sales_data' => $saleData,
        ]);
    }

    /**
     * Blank page for custom layouts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blank()
    {
        return view('layouts.blank-page');
    }
}
