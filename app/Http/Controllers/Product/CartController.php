<?php

namespace App\Http\Controllers\Product;

use App\Wishlist;
use Illuminate\Http\Request;
use App\Categories;
use App\User;
use App\Product;
use App\PImages;
use App\Cart;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Response;
use Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->name;

            return $next($request);
        });
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest'); //or auth
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function add($id)
    {
        $user = Auth::user();
        $product = Product::where('id', $id)->get();
        $data = array();
        $data['users_id'] = $user->id;
        $data['products_id'] = $product->first()->id;
        $data['amount'] = 1;
        $updater = Cart::where('products_id', '=', $id)->first();
        if (Cart::where('products_id', '=', $id)->exists()) {
            $updater->amount = $updater->amount + 1;
            $updater->save();
        } else
            Cart::create($data);
        return redirect()->back();
    }

    public function decrease($id)
    {
        $cmd = Cart::where('products_id', $id)->where('users_id', Auth::user()->id)->first();

        if ($cmd->exists())

            if ($cmd->amount > 1    ) {
                $cmd->amount = $cmd->amount - 1;
                $cmd->save();
            } else {
                $cmd->delete();
            }

            return redirect()->back();

    }

    public function remove($id)
    {
//        dd($id);
//        $user = Auth::user();
//        $product = Product::where('id',id)->get();

        $cmd = Cart::where('products_id', $id)->where('users_id', Auth::user()->id)->delete();
//        $cmd = Wishlist::all();
//        dd($cmd);
        return redirect()->back();
    }

    public
    function index()
    {
        $user = Cart::select('products_id')->where('users_id', Auth::user()->id)->get();
        $cart = Cart::all();
        $data = Product::all();
        $products = array();

        foreach ($data as $single) {
//            dd($single->id);
            if ($user->isEmpty())
                break;
            if ($user->first()->products_id == $single->id) {
//                $products[] = $single;
                array_push($products, $single);
            }
        }
//        dd($products);
        return view('cart', ['wishlist' => $products, 'cart' => $cart]);
    }

}
