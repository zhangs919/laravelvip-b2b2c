<?php

use Illuminate\Database\Seeder;

class TemplateSelectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\TemplateSelector::create(['id' => 3, 'selector_name' => '图片选择器', 'code' => 'image_selector']);
    }
}
