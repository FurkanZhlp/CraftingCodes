<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('options')->insert([
            "id"=>1,
            "title"=>"CraftingCodes",
            "meta_desc"=>"Hayallerinizi Kodlara Döküyoruz..",
            "meta_tags"=>"Minecraft,Kod,Website,Webscript,satış,ücretsiz,ucuz",
            "logo_url"=>""
        ]);
    }
}
