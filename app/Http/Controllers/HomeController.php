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
        $totalUsers = User::count();
        $totalSales = Sale::sum('total_amount');
        $totalProducts = Product::count();

        $today = now()->startOfDay();
        $todaySales = Sale::where('created_at', '>=', $today)->sum('total_amount');
        $todayUsers = User::where('created_at', '>=', $today)->count();
        $todayProducts = Product::where('created_at', '>=', $today)->count();

        $startOfMonth = now()->startOfMonth();
        $monthSales = Sale::where('created_at', '>=', $startOfMonth)->sum('total_amount');
        $monthUsers = User::where('created_at', '>=', $startOfMonth)->count();
        $monthProducts = Product::where('created_at', '>=', $startOfMonth)->count();

        $startOfYear = now()->startOfYear();
        $yearSales = Sale::where('created_at', '>=', $startOfYear)->sum('total_amount');
        $yearUsers = User::where('created_at', '>=', $startOfYear)->count();
        $yearProducts = Product::where('created_at', '>=', $startOfYear)->count();

        $saleCounts = Sale::selectRaw('DATE(created_at) as date, sum(total_amount) as total_sales')->groupBy('date')->orderBy('date', 'asc')->get();

        $saleLabels = $saleCounts->pluck('date')->toArray();
        $saleData = $saleCounts->pluck('total_sales')->toArray();

        return view('home', [
            'totalUsers' => $totalUsers,
            'totalSales' => $totalSales,
            'totalProducts' => $totalProducts,
            'todaySales' => $todaySales,
            'todayUsers' => $todayUsers,
            'todayProducts' => $todayProducts,
            'monthSales' => $monthSales,
            'monthUsers' => $monthUsers,
            'monthProducts' => $monthProducts,
            'yearSales' => $yearSales,
            'yearUsers' => $yearUsers,
            'yearProducts' => $yearProducts,
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
