<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'settings_description' => 'Baslig',
                'settings_key' => 'title',
                'settings_value' => 'Laravel ECMS Learning',
                'settings_type' => 'text',
                'settings_must' => 0,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Izahat',
                'settings_key' => 'description',
                'settings_value' => 'Laravel ECMS Learning description',
                'settings_type' => 'text',
                'settings_must' => 1,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'logo',
                'settings_key' => 'logo',
                'settings_value' => 'logo.png',
                'settings_type' => 'file',
                'settings_must' => 2,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Icon',
                'settings_key' => 'icon',
                'settings_value' => 'ico.png',
                'settings_type' => 'file',
                'settings_must' => 3,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Acar soz',
                'settings_key' => 'keywords',
                'settings_value' => 'Laravel 6 CMS Ferhad Musayev',
                'settings_type' => 'text',
                'settings_must' => 4,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Telefon',
                'settings_key' => 'phone',
                'settings_value' => '+994(XX) XXX XX XX',
                'settings_type' => 'text',
                'settings_must' => 5,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Telefon GSM',
                'settings_key' => 'phone_gsm',
                'settings_value' => '+994(XX) XXX XX XX',
                'settings_type' => 'text',
                'settings_must' => 6,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Mail',
                'settings_key' => 'mail',
                'settings_value' => 'ferhad.musayev.00@bk.ru',
                'settings_type' => 'text',
                'settings_must' => 7,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'ilce',
                'settings_key' => 'ilce',
                'settings_value' => 'Topqapi',
                'settings_type' => 'text',
                'settings_must' => 8,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Il',
                'settings_key' => 'il',
                'settings_value' => 'Baku',
                'settings_type' => 'text',
                'settings_must' => 9,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Adres',
                'settings_key' => 'address',
                'settings_value' => 'Topqapi sayari',
                'settings_type' => 'text',
                'settings_must' => 10,
                'settings_delete' => '0',
                'settings_status' => '1'
            ]
        ]);
    }
}
