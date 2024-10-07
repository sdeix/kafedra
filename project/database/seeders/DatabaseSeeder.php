<?php
use Database\Factories\UserFactory;
use Database\Factories\ProductFactory;
use Database\Factories\CartFactory;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        
        UserFactory::new()->count(10)->create();
        ProductFactory::new()->count(20)->create();
        CartFactory::new()->count(10)->create();
        OrderFactory::new()->count(10)->create();
    }
}