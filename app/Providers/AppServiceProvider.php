<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                // Count number of unique cart items (not total quantity)
                $cartCount = CartItem::where('user_id', Auth::id())->count();
            }

            $view->with('cartCount', $cartCount);
            session(['cart_count' => $cartCount]);
        });
        View::composer('*', function ($view) {
            $activeOrdersCount = Order::whereNotIn('order_status', ['delivered', 'cancelled'])->count();
            $view->with('activeOrdersCount', $activeOrdersCount);
        });
    }
}
