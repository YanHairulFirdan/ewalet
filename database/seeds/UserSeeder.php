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
        factory(App\Models\User::class, 100)->create();
        factory(App\Models\User::class)->create(['phone_number' => '123456']);
    }
}
