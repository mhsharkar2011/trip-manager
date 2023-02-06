<?php

namespace Database\Seeders;

use App\Devpanel\Models\Entity;
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
                'type_label' => 'string',
            ],
            [
                'name' => 'Link 1',
                'type' => 'string',
                'type_label' => 'string',
            ],
            [
                'name' => 'Link 2',
                'type' => 'string',
                'type_label' => 'string',
            ],
        ]);

        $e2 = Entity::create([
        'name' => "Team Members"
        ]);

        $e2->fields()->createMany([
            [
                'name' => 'name',
                'type' => 'string',
                'type_label' => 'string',
            ],
            [
                'name' => 'designation',
                'type' => 'string',
                'type_label' => 'string',
            ],
            [
                'name' => 'message',
                'type' => 'text',
                'type_label' => 'text',
            ],
            [
                'name' => 'joining_date',
                'type' => 'date',
                'type_label' => 'date',
            ],            
            [
                'name' => 'picture',
                'type' => 'image',
                'type_label' => 'image',
            ],            
        ]);

    }
}
