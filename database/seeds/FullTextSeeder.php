<?php

use Illuminate\Database\Seeder;

class FullTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FullText::where('id', 0)->delete();

        \App\Models\FullText::create([
            'abstraction_id' => 0,
            'url' => 'default',
            'description' => 'Lorem',
        ]);

        $change = \App\Models\FullText::orderBy('id', 'desc')->first();
        $change->id = 0;
        $change->save();
    }
}
