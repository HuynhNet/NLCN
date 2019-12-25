<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\type_product;
use App\Giohang;
use App\product;
use Session;
use DB;
use Carbon;


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
    public function boot(){

        view()->composer('page.home', function($view){
            $product = product::all();
            $view->with('type_product',$product);
        });

        view()->composer('page.cart', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Giohang($oldCart);
                $view->with([
                    'cart'=>Session::get('cart'), 
                    'product_cart'=>$cart->items,
                    'totalPrice'=>$cart->totalPrice,
                    'totalQty'=>$cart->totalQty
                ]);
            }
        });

        view()->composer('page.view-product', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Giohang($oldCart);
                $view->with([
                    'cart'=>Session::get('cart'), 
                    'product_cart'=>$cart->items,
                    'totalPrice'=>$cart->totalPrice,
                    'totalQty'=>$cart->totalQty
                ]);
            }
        });

        view()->composer('header', function($view){
            $product = product::all();
            $firmPhone = DB::table('products')->select('firm')->where('id_type', 1)->distinct()->get();
            $firmLaptop = DB::table('products')->select('firm')->where('id_type', 2)->distinct()->get();
            $firmTablet = DB::table('products')->select('firm')->where('id_type', 4)->distinct()->get();
            $firmHeadphone = DB::table('products')->select('firm')->where('id_type', 3)->distinct()->get();
            $view->with([
                'product'=>$product,
                'firmPhone'=>$firmPhone,
                'firmLaptop'=>$firmLaptop,
                'firmTablet'=>$firmTablet,
                'firmHeadphone'=>$firmHeadphone
            ]);
        });

        // view()->composer('admin.admin', function($view){
        //     $user = DB::table('users')->where('id_level', 3)->count();
        //     $admin = DB::table('users')->where('id_level', 1)->count();
        //     $toDate = Carbon\Carbon::now();
        //     $bill = DB::table('bills')->where('created_at', $toDate)->count();
        //     $product = DB::table('products')->count();
        //     $
        //     $view->with([
        //         'user'=>$user,
        //         'bill'=>$bill,
        //         'product'=>$product
        //     ]);
        // });
    }
}
