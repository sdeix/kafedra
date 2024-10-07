<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = User::where('token', $request->bearerToken())->first();
        $cart = Cart::where('user_id', $user->id)->first();
    
      
        if (!$cart) {
            return response()->json(['message' => 'Корзина пуста'], 422);
        }
    
        
        $order = new Order();
        $order->user_id = $user->id;
        $order->products = $cart->products->pluck('id')->implode(',');
        $order->order_price = $cart->products->sum('price');
        $order->save();
    
      
        $cart->delete();
    
        return response()->json(['message' => 'Заказ оформлен успешно']);
    }

    public function getOrders(Request $request)
{
    $user = User::where('token', $request->bearerToken())->first();
    $orders = Order::where('user_id', $user->id)->get();

    if(count($orders)==0){
        return response()->json(['error' => 'Нет оформленных заказов'],422); 
    }

    return response()->json($orders);
}
}