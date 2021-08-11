<?php

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
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->transactions()->save(factory(App\Transaction::class)->make());
            $user->payments()->save(factory(App\Models\Payment::class)->make());
            Log::info("ok");
            $user->subscription()->save(factory(App\Models\Subscription::class)->make());

            // make subscription
        });
    }
}
