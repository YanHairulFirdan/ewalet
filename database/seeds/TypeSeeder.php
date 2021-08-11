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
        $names = [
            'Coba Gratis' => 0,
            'Bulanan'     => 10000,
            'Tahunan'     => 100000,
        ];

        foreach ($names as $name => $price) {
            Type::create([
                'name'  => $name,
                'price' => $price,
            ]);
        }
    }
}
