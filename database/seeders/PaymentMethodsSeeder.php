<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            'mail' => 'Email',
            'sms' => 'SMS',
        ];

        foreach ($paymentMethods as $slug => $name) {
            PaymentMethod::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }
    }
}
