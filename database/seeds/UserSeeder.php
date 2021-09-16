<?php

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Type;
use App\Models\Transaction;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 100)->create()->each(function ($user, Faker $faker) {
            for ($i = 0; $i < rand(0, 40); $i++) {
                $weight         = $faker->randomNumber(2);
                $price_per_kilo = rand(8000000, 10000000);

                Transaction::create([
                    'user_id'        => $user->id,
                    'buyer'          => $faker->name,
                    'weight'         => $weight,
                    'price_per_kilo' => $price_per_kilo,
                    'total_price'    => $weight * $price_per_kilo,
                    'created_at'     => Carbon::today()->subDays(rand(0, 365))
                ]);
            }
            $type = Type::inRandomOrder()->first();

            Payment::create([
                'user_id'    => $user->id,
                'amount'     => $type->price,
                'created_at' => Carbon::today()->subDays(rand(0, 365))
            ]);

            $subscriptionDays = $type->name == 'Coba Gratis' || $type->name == 'Bulanan' ? 30 : 360;

            $started_at = Carbon::now();
            $ended_at   = Carbon::now()->addDays($subscriptionDays);

            Subscription::create([
                'user_id' => $user->id,
                'type_id' => $type->id,
                'started_at' => $started_at,
                'end_at'     => $ended_at,
                'status'     => true
            ]);
        });
    }
}
