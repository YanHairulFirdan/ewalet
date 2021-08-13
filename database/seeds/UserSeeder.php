<?php

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Type;
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
        $faker = Factory::create();

        $users = factory(App\User::class, 10)->create()->each(function ($user) use ($faker) {
            for ($i = 0; $i < rand(0, 40); $i++) {
                $weight         = $faker->randomNumber(2);
                $price_per_kilo = rand(8000000, 10000000);

                Transaction::create([
                    'user_id'        => $user->id,
                    'buyer'          => $faker->name,
                    'weight'         => $weight,
                    'price_per_kilo' => $price_per_kilo,
                    'total_price'    => $weight * $price_per_kilo,
                ]);

                $type = Type::inRandomOrder()->first();

                Payment::create([
                    'user_id' => $user->id,
                    'amount' => $type->price,
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
            }



            // $user->transactions()->createMany(
            //     factory(App\Transaction::class, 2)->make()->toArray()
            // );
            // $user->payments()->save(factory(App\Models\Payment::class)->make());
            // Log::info("ok");
            // $user->subscription()->save(factory(App\Models\Subscription::class)->make());

            // make subscription
        });
    }
}
