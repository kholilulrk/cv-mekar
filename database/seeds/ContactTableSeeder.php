<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contacts')->truncate();

        \App\Models\Contact::create([
            'email' => 'email@email.com',
            'phone' => '+62 00000000',
            'address' => 'Surabaya'
        ]);
    }
}
