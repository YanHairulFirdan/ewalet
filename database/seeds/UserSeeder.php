<?php

use App\Transaction;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Str;
use Illuminate\Support\Str;
use PhpParser\Builder\Trait_;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class)->create()->each(function ($user) {
        //     $user->transactions()->createMany(factory(App\Transaction::class, 100)->make()->toArray());
        // });
        $faker = Factory::create();

        $user = new User(
            [
                'name' => 'User',
                'phone_number' => '08754466788999',
                'password' => Hash::make('paswordku1234'), // password
                'remember_token' => Str::random(10)
            ]
        );

        $user->save();

        for ($i = 0; $i < 100; $i++) {
            $weight         = $faker->randomNumber(2);
            $price_per_kilo = rand(8000000, 10000000);

            Transaction::create(
                [
                    'user_id'        => $user->id,
                    'buyer'          => $faker->name,
                    'weight'         => $weight,
                    'price_per_kilo' => $price_per_kilo,
                    'total_price'    => $weight * $price_per_kilo,
                    'created_at'     => $faker->dateTimeThisYear
                ]
            );
        }
    }
}
