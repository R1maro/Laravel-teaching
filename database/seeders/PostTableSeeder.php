<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;


class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {


        Post::factory(100)->create();


//      soft delete gonna save this deleted posts
        Post::inRandomOrder()->limit(3)->delete();



//        for ($i = 0; $i < 20; $i++ ){
//            $p = new Post();
//            $p->title = 'my title'.$i;
//            $p->slug = 'my title'.$i;
//            $p->body = 'body';
//            $p->save();
//
//        }
    }
}
