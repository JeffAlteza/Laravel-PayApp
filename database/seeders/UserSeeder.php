<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //$stats =$faker->randomElement(['success', 'failed']);
        //$stats = $faker->randomElement(['success', 'failed']);
        for ($i = 0; $i < 1000; $i++) {
            DB::table('payment_transactions')->insert([
                'student_ref_no' => $faker->ean8,
                'fullname' => $faker->name,
                'email' => $faker->email,
                'mobile_no' => $faker->ean8,
                'amount' => $faker->numberBetween(1, 10000),
                'payment_for' => $faker->word,
                'date_of_trans' => $faker->date('Y_m_d'),
                'payment_method'=> $faker->creditCardType,
                'paymaya_ref_no'=>$faker->ean8,
                'transaction_id'=>$faker->ean13,
                'status'=>$faker->randomElement(['success', 'failed']),

            ]);
        }


    }
}
