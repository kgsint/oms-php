<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Dotenv\Dotenv;
use App\Models\User;
use Faker\Factory as FakerFactory;

// psr-4 autoload
require __DIR__ . "/vendor/autoload.php";
// load .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


// faker instance
$faker = FakerFactory::create();



for($i = 0; $i < 5; $i++) {
    Category::factory()->create([
        'name' => $faker->word(),
        'active' => rand(0, 1),
    ]);
}


for($i = 0; $i < 5; $i++) {
    User::factory(10)->create([
        'name' => $faker->firstName(),
        'email' => $faker->safeEmail(),
        'password' => password_hash('password', PASSWORD_BCRYPT),
        'role_id' => rand(1, 3),
        'phone' => $faker->e164PhoneNumber(),
        'address' => $faker->address(),
    ]);
}

for($i = 0; $i < 5; $i ++) {
    Product::factory()->create([
        'title' => str_replace(['.', ',', '!', '?'], '', $faker->realText(10)),
        'description' => $faker->realText(),
        'price' => rand(1000, 20000),
        'active' => rand(0, 1),
    ]);
}

for($i = 0; $i < 5; $i ++) {
    Order::factory()->create([
        'uuid' => $faker->uuid(),
        'user_id' => rand(1, 5),
        'product_id' => rand(1, 5),
        'quantity' => rand(1, 10),
        'status' => rand(1, 3),
    ]);
}

echo "Done populating \n";