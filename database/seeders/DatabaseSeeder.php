<?php

namespace Database\Seeders;

use App\Models\Entity;
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
        $e1 = Entity::create([
        'name' => "Insurance Types"
        ]);

        $e1->fields()->createMany([
            [
                'name' => 'Description',
                'type' => 'string',
            ],
            [
                'name' => 'Link 1',
                'type' => 'string',
            ],
            [
                'name' => 'Link 2',
                'type' => 'string',
            ],
        ]);

        $e2 = Entity::create([
        'name' => "Team Members"
        ]);

        $e2->fields()->createMany([
            [
                'name' => 'name',
                'type' => 'string',
            ],
            [
                'name' => 'designation',
                'type' => 'string',
            ],
            [
                'name' => 'message',
                'type' => 'text',
            ],
            [
                'name' => 'joining_date',
                'type' => 'date',
            ],            
            [
                'name' => 'picture',
                'type' => 'image',
            ],            
        ]);

    }
}
