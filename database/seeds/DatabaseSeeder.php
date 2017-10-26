<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //type
        DB::table('types')->insert([
            ['name' => 'youtube'],
            ['name' => 'app'],
            ['name' => 'artikel'],
            ['name' => 'buku'],
            ['name' => 'custom'],
        ]);

        //Tags
        DB::table('tags')->insert([
            ['name' => 'tech'],
            ['name' => 'startup'],
            ['name' => 'bisnis'],
            ['name' => 'kimia'],
            ['name' => 'fisika'],
            ['name' => 'matematika'],
            ['name' => 'ekonomi'],
        ]);

        //user
        factory(App\Models\User::class, 20)->create()->each(function($user){
            //social
           $user->social()->save(factory(App\Models\Social::class)->make());
           //product
           $user->products()->save(factory(App\Models\Product::class)->make());
           //product Comment
           $user->product_comments()->save(factory(App\Models\ProductComment::class)->make());
        });

        //Makers
        factory(App\Models\Maker::class, 20)->create();


        //Product Tag
        App\Models\Product::all()->each(function($product){
            factory(App\Models\ProductTag::class)->create([
                'product_id' => $product->id
            ]);
        });

        //Admin Account
        factory(App\Models\Admin::class, 1)->create();
    }
}
