<?php

namespace Database\Seeders;

use App\Models\NotificationMethod;
use Illuminate\Database\Seeder;

class NotificationMethodsSeeder extends Seeder
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
            NotificationMethod::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }
    }
}
