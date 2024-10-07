<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;

class CartController extends Controller
{
    public function addProduct(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Товар не найден'], 404);
        }
        $user = User::where('token', $request->bearerToken())->first();
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id]);
        }
    
        $cart->products()->attach($product->id);
    
        return response()->json(['message' => 'Товар добавлен в корзину']);
    }

    public function getCart(Request $request)
    {
        $user = User::where('token', $request->bearerToken())->first();
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json(['error' => 'Корзина пуста'], 404);
        }

        $products = $cart->products;
        $products->transform(function ($product,$index) {
            $product->product_id = $product->pivot->product_id;
            $product->id = $index + 1;
            $product->makeHidden('pivot');
            return $product;
        });
        return response()->json($products);
    }
}