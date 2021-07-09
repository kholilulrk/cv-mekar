<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->truncate();

        \App\Models\Setting::create([
            'title' => 'Website Title',
            'author' => 'Websti Author',
            'keyword' => 'keyword, keyword, keyword',
            'short_description' => 'In hac habitasse platea dictumst. Proin viverra sem a quam tincidunt, ut condimentum tortor maximus.',
            'description' => 'Morbi facilisis justo nisi, in porta est vehicula eget. Maecenas efficitur quam ut nulla rutrum sodales. Donec at urna vitae lorem hendrerit vehicula rhoncus sit amet purus. Pellentesque venenatis, leo id elementum tristique, quam sapien cursus massa, ultricies accumsan turpis lacus ut elit. Aenean ac pharetra odio. Mauris fringilla, dui a euismod facilisis, nibh tortor porta sapien, ut iaculis augue leo quis dui. Praesent id ultricies urna. Quisque porta sagittis euismod. Duis hendrerit varius egestas. Cras gravida neque at posuere malesuada. Cras nec ex in erat efficitur euismod. Mauris lobortis risus eget est accumsan sollicitudin.',
            'fb_pixel' => null,
            'google_analytic' => null,
            'icon' => null,
            'logo' => null,
            'logo_grayscale' => null
        ]);
    }
}
