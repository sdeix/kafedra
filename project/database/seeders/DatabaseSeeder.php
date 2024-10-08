<?php
use Database\Factories\UserFactory;
use Database\Factories\ProductFactory;
use Database\Factories\CartFactory;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'admin@shop.ru',
            'password'=> Hash::make('QWEasd123'),
            'fio'=>"Администраторный Администратор",
            'role'=>'admin'
        ]);
        User::create([
            'email' => 'user@shop.ru',
            'fio'=>'Пользовательский пользователь',
            'password'=> Hash::make('password')
        ]);
        UserFactory::new()->count(10)->create();
        ProductFactory::new()->count(20)->create();
        CartFactory::new()->count(10)->create();
        OrderFactory::new()->count(10)->create();
    }
}