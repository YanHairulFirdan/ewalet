<?php

use App\Models\SubscriptionType;
use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Coba Gratis' => 0,
            'Bulanan'     => 10000,
            'Tahunan'     => 100000,
        ];

        foreach ($names as $name => $price) {
            SubscriptionType::create([
                'name'  => $name,
                'price' => $price,
            ]);
        }
    }
}
