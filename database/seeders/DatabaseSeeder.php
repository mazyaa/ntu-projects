<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Existing seeders (PHASE 1)
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(EnglishContentSeeder::class);

        // PHASE 2 seeders
        $this->call(SkillSeeder::class);
        $this->call(RiksaUjiCategorySeeder::class);
        $this->call(TeamMemberSeeder::class);
        $this->call(EquipmentSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ServicesTabSeeder::class);
    }
}
