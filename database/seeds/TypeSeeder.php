<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name'   => 'Coba Gratis',
                'prices' => 10000,
                'days'   => 30
            ],
            [
                'name'   => 'Bulanan',
                'prices' => 10000,
                'days'   => 30
            ],
            [
                'name'   => 'Tahunan',
                'prices' => 100000,
                'days'   => 365
            ],
        ];

        foreach ($types as $name => $type) {
            Type::create([
                'name'              => $type['name'],
                'price'             => $type['price'],
                'subscription_days' => $type['subscription_days']
            ]);
        }
    }
}
