<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $products = ProductFactory::new()->count(3)->create(); 
        $productString = $products->pluck('id'); 

        return [
            'user_id' => UserFactory::new()->create()->id,
            'order_price' => $this->faker->randomFloat(2, 1, 10000),
            'products' => $productString, 
        ];
    }
}