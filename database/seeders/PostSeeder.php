<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        for ($i=0; $i <20 ; $i++) {
            $title = Str::random(20);
            $c = Category::inRandomOrder()->first();
            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a felis nec justo tristique commodo. Maecenas ut risus nec dui sollicitudin dictum vel nec arcu. Curabitur vitae urna vel lectus sodales elementum pharetra vitae elit. Quisque vitae mollis odio, ut mollis odio. Proin laoreet, dolor sit amet sodales malesuada',
                'description' => 'Nunc viverra in mi ut hendrerit. Nam metus libero, varius eget metus eget, auctor porttitor nisl. Sed hendrerit, dolor vehicula mattis dictum, ex erat ultricies justo',
                'posted' => 'yes',
                'category_id' => $c->id
            ]);
        }
    }
}
