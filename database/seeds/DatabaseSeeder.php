<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            "name"      =>  "Furkan Yalçın Özhalep",
            "email"     =>  "furkanzhlp@hotmail.com",
            "password"  =>  Hash::make("123123"),
            "username"  =>  "Green",
            "admin"     =>  1,
            "role"     =>  1
        ]);
        $faker = Faker::create();
        for($i=1;$i<=20;$i++)
        {
            User::create([
                "name"      =>  $faker->name,
                "email"     =>  $faker->email,
                "password"  =>  Hash::make("123123"),
                "username"  =>  $faker->userName
            ]);
        }
    }
}
