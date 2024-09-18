<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // //
        // Paginator::useBootstrap();
        // //
        // $website=DB::table('websites')->leftJoin('currencies','websites.currency_id','currencies.id')
        //         ->select('websites.*','currencies.symbol')->first();
        // view()->share('website',$website);
    }
}
