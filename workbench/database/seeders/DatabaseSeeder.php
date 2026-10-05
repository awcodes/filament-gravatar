<?php

declare(strict_types=1);

namespace Workbench\Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Workbench\Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Fixed users at fixed dates, so documentation screenshots are the same on every build. The Focus fixtures
        // in workbench/fixtures/gravatar give Test User and Amara Okafor a picture of their own; the others have no
        // Gravatar and fall back to the panel's configured default image.
        $users = [
            ['Test User', 'test@example.com'],
            ['Maria Garcia', 'maria.garcia@example.com'],
            ['Kenji Tanaka', 'kenji.tanaka@example.com'],
            ['Amara Okafor', 'amara.okafor@example.com'],
            ['Lukas Becker', 'lukas.becker@example.com'],
        ];

        foreach ($users as $index => [$name, $email]) {
            $date = CarbonImmutable::parse('2026-01-01 09:00:00')->addDays($index);

            UserFactory::new()->create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
