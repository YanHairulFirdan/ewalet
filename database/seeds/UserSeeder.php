<?php

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        DB::transaction(function () {
            $faker = Factory::create();
            $users = factory(User::class, 100)->create()->each(function ($user) use ($faker) {
                factory(Transaction::class, rand(1, 30))->create(['user_id' => $user->id]);
                Log::info($user->id);
            });

            $dummyUser = Factory(User::class)->create([
                'phone_number' => '088888888888',
                'password'     => Hash::make('userpass')
            ]);

            // $this->createUserData($dummyUser, $faker);
        });
    }

    public function createUserData(User $user, Generator $faker)
    {
        $type             = Type::inRandomOrder()->first();
        $subscriptionDays = $type->name == 'Coba Gratis' || $type->name == 'Bulanan' ? 30 : 360;
        $started_at       = Carbon::now();
        $weight           = $faker->randomNumber(2);
        $price_per_kilo   = rand(8000000, 10000000);

        for ($transaction = 0; $transaction < rand(1, 20); $transaction++) {
            $transaction = new Transaction([
                'user_id'        => $user->id,
                'buyer'          => $faker->name,
                'weight'         => $weight,
                'price_per_kilo' => $price_per_kilo,
                'total_price'    => $weight * $price_per_kilo
            ]);
            $transaction->user_id = $user->id;
            $transaction->save();
        }
        $user->payments()->create([
            'amount'     => $type->price,
            'created_at' => Carbon::today()->subDays(rand(0, 365))
        ]);

        $user->subscription()->create([
            'type_id'    => $type->id,
            'started_at' => $started_at,
            'end_at'     => $started_at->addDays($subscriptionDays),
            'status'     => true
        ]);
    }
}
