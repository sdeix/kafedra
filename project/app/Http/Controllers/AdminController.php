<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function addNewProduct(Request $request)
    {

        $product = new Product();
    

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 403);
        }

        $product->save();
    

        return response()->json(['id'=>$product->id,'message' => 'Товар добавлен успешно']);
    }

    public function deleteProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return response()->json(['error' => 'Продукт не найден'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product removed']);
    }
    public function patchProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return response()->json(['error' => 'Продукт не найден'], 404);
        
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:10',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }
}