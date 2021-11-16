<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Equiptment;
use App\Models\Labor;
use App\Models\OtherExpensis;

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
        // \App\Models\User::factory(10)->create();
        Material::factory(50)->create();
        Equiptment::factory(50)->create();
        Labor::factory(50)->create();
        OtherExpensis::factory(50)->create();

       /*  $material = new Material();

        $material->unit("GAL");
        $material->description("RT- MAC 710 PRIMER");
        $material->unit_price(99.68);

        $material->save(); */

    }
}
