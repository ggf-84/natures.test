<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\Terranet\Options\Option::all()->count() > 0) {
            return;
        }

        DB::table('options')->insert([
            ['key' => 'facebook_link', 'value' => '', 'group' => 'socials'],
            ['key' => 'instagram_link', 'value' => '', 'group' => 'socials'],
            ['key' => 'twiter_link', 'value' => '', 'group' => 'socials'],

            ['key' => 'email', 'value' => 'business@natures.org', 'group' => 'contacts'],
            ['key' => 'phone', 'value' => '(+373) 690480480', 'group' => 'contacts'],

            ['key' => 'price_tree', 'value' => '2', 'group' => 'general'],
        ]);
    }
}
