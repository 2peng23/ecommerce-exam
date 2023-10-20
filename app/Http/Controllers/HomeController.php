<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $cartCount = null;
        $user = Auth::user();
        if ($user) {
            if ($user->usertype == 0) {
                $id = Auth::id();
                $cartCount = CartItem::where('user_id', $id)->count();
                $data = Product::all();
                return view('user.home', compact('data', 'cartCount'));
            } else if ($user->usertype == 1) {
                $product = Product::all()->count();
                $cartItem = CartItem::all()->count();
                $title = 'Dashboard';
                return view('admin.home', compact('title', 'product', 'cartItem'));
            }
        }
        return view('welcome');
    }
}
