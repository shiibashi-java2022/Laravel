<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Faker\Factory;
use Faker\Factory as FakerFactory;
use App\Models\Book;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $faker = FakerFactory::create('ja_JP');
        for($i = 0; $i < 10; $i++){
            Book::create([
                'item_name' => $faker->word(), //文字列
                 'user_id' => $faker->numberBetween(1, 2), //1〜2
                 'item_number' => $faker->numberBetween(1, 999), //1〜999
                 'item_amount' => $faker->numberBetween(100, 5000), //100〜5000
                 'item_img'=> $faker->image("./public/upload", 300, 300, 'cats', false),
                 'published' => $faker->dateTime('now'), //現在までYmdHis
                 'created_at' => $faker->dateTime('now'), //現在までYmdHis
                 'updated_at' => $faker->dateTime('now'), //現在までYmdHis
            ]);
        }
       
    }
}
