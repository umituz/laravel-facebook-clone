<?php

use Illuminate\Database\Seeder;

/**
 * Class PostSeeder
 */
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('posts')->truncate();

        DB::table('posts')->insert([
            ['user_id' => 1, 'body' => 'First very cool post','created_at' => now(),'updated_at' => now()],
            ['user_id' => 1, 'body' => 'Second very cool post','created_at' => now(),'updated_at' => now()],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
