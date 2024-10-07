<?php
namespace Database\Factories;

use App\Models\CartProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartProductFactory extends Factory
{
    protected $model = CartProduct::class;

    public function definition()
    {
        return [
            'cart_id' => CartFactory::new()->create()->id,
            'product_id' => ProductFactory::new()->create()->id,
        ];
    }
}