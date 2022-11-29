<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UserSeeder::class);

       Setting::create([
            'code' => 'application_logo',
            'type' => 'FILE',
            'label' => 'Application logo',
            'value' => 'VfCEKcFE0t.jpg',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'application_title',
            'type' => 'TEXT',
            'label' => 'Social App',
            'value' => 'SMN',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'favicon_logo',
            'type' => 'FILE',
            'label' => 'Favicon Logo',
            'value' => 'quTPXQDbDe.png',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'copyright',
            'type' => 'TEXT',
            'label' => 'Application',
            'value' => 'SMN',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'indian_balance',
            'type' => 'TEXT',
            'label' => 'Indian Balance',
            'value' => '0',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'dubai_balance',
            'type' => 'TEXT',
            'label' => 'Dubai Balance',
            'value' => '0',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'conversation_rate',
            'type' => 'TEXT',
            'label' => 'Conversation Rate',
            'value' => '4325',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'usd_balance',
            'type' => 'TEXT',
            'label' => 'Usd Balance',
            'value' => '0',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'conversation_rate_inr',
            'type' => 'TEXT',
            'label' => 'Conversation Rate Inr',
            'value' => '4818',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'conversation_rate_usd',
            'type' => 'TEXT',
            'label' => 'Conversation Rate Usd',
            'value' => '3.6725',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'conversation_rate_aed_to_inr',
            'type' => 'TEXT',
            'label' => 'Conversation Rate Aed To Inr',
            'value' => '4818',
            'hidden' => '0',
        ]);

        Setting::create([
            'code' => 'conversation_rate_aed_to_usd',
            'type' => 'TEXT',
            'label' => 'Conversation Rate Aed To Usd',
            'value' => '3.6725',
            'hidden' => '0',
        ]);
    }
}
