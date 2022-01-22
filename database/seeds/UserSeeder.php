<?php

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transaction as ModelsTransaction;
use App\Models\Type;
use App\Models\User;
use App\Transaction;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 100)->create()->each(function ($user) use ($faker) {
            $faker = Factory::create();
            for ($i = 0; $i < rand(0, 40); $i++) {
                $weight           = $faker->randomNumber(2);
                $price_per_kilo   = rand(8000000, 10000000);
                $type             = Type::inRandomOrder()->first();
                $subscriptionDays = $type->name == 'Coba Gratis' || $type->name == 'Bulanan' ? 30 : 360;
                $started_at       = Carbon::now();

                $user->transactions([
                    'buyer'          => $faker->name,
                    'weight'         => $weight,
                    'price_per_kilo' => $price_per_kilo,
                    'total_price'    => $weight * $price_per_kilo,
                    'created_at'     => Carbon::today()->subDays(rand(0, 365))
                ]);
            }

            $user->payments()->create([
                'amount'     => $type->price,
                'created_at' => Carbon::today()->subDays(rand(0, 365))
            ]);

            $user->subscription()->create([
                'type_id' => $type->id,
                'started_at' => $started_at,
                'end_at'     => $started_at->addDays($subscriptionDays),
                'status'     => true
            ]);
        });
    }
}
