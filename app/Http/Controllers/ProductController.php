<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function allProducts()
    {
        $data = Product::paginate(5);
        $title = 'Products';
        return view('admin.Product', compact('title', 'data'));
    }
    public function saveProduct(Request $request)
    {
        $data = new Product();
        $data->name = $request->input('name');
        $data->price = $request->input('price');

        $photo = $request->image;
        $photoname = time() . '.' . $photo->getClientOriginalExtension();
        $request->image->move('images', $photoname);
        $data->image = $photoname;

        $data->save();

        return redirect()->back();
    }

    public function addCart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $existing_cartItem = CartItem::find($id);
            if ($existing_cartItem) {
                $existing_cartItem->quantity = $request->quantity + $existing_cartItem->quantity;
                $existing_cartItem->save();
                return redirect()->back();
            } else {

                $cart = new CartItem();
                $cart->user_id = $user->id;
                $cart->user_name = $user->name;
                $cart->name = $request->name;
                $cart->image = $request->image;
                $cart->price = $request->price;
                $cart->quantity = $request->quantity;

                $cart->save();

                return redirect()->back();
            }
        }

        return redirect('/login');
    }
    public function viewCart($id)
    {
        $cartItems = CartItem::where('user_id', $id)->get();
        $cartCount = $cartItems->count();

        return view('user.CartItem', compact('cartItems', 'cartCount'));
    }

    public function updateCart(Request $request, $id)
    {
        $cart = CartItem::find($id); // Use find instead of where to get the specific cart item
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        return redirect()->back();
    }
    public function getTotalPrice()
    {
        $userId = auth()->id(); // Get the authenticated user's ID
        $cartItems = CartItem::where('user_id', $userId)->get(); // Filter by the user's ID
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity; // Use += for addition here
        }
        return $totalPrice;
    }



    public function deleteCartItem($id)
    {
        $cartItem = CartItem::find($id);
        $cartItem->delete();
        return redirect()->back();
    }

    public function allCart()
    {
        $title = 'Cart Items';
        $data = CartItem::paginate(5);
        return view('admin.CartItem', compact('data', 'title'));
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        if (empty($request->image)) {
            $product->image = $product->image; // Set the default image name here
        } else {

            // image
            $photo = $request->image;
            $photoname = time() . '.' . $photo->getClientOriginalExtension();
            $request->image->move('images', $photoname);
            $product->image = $photoname;
        }

        $product->save();

        return redirect('/all-products');
    }
}
