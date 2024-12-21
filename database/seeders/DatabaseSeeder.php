<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Retreive Collection Author IDs from diff db
         */
        $authorsId = DB::table('x1microservices_author_service.authors')->pluck('id');

        Book::factory(100)->create([
            'author_id' => function () use ($authorsId) {
                return $authorsId->random();
            },
        ]);
    }
}
