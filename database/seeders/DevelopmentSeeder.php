<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Category;
use App\Models\ContactItem;
use App\Models\Fdtrck;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactItem::factory()->count(4)->create();
        ContactItem::factory()
            ->order(100)
            ->button()
            ->create();

        About::factory()->count(1)->create();

        Category::factory()
            ->count(5)
            ->has(
                Fdtrck::factory()
                    ->count(rand(3, 5))
                    ->has(MenuItem::factory()->count(rand(3, 5)))
            )
            ->create();
    }
}
