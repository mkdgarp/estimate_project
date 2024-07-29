<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workload;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'rank' => '0', //Admin bypass rank checked
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'rank' => '1',
        ]);

        User::factory()->create([
            'name' => 'นายทดสอบ ระบบ 1',
            'email' => 'professor1@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'rank' => '2',
        ]);

        User::factory()->create([
            'name' => 'นายเทส ระบบ 2',
            'email' => 'professor2@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'rank' => '2',
        ]);

        Workload::create([
            'name' => 'ภาระงานสอน',
            'description' => '',
        ]);
        Workload::create([
            'name' => 'ภาระงานวิจัยและงานวิชาการอื่น',
            'description' => '',
        ]);
        Workload::create([
            'name' => 'ภาระงานบริการวิชาการ',
            'description' => '',
        ]);
        Workload::create([
            'name' => 'ภาระงานทำนุบำรุงศิลปวัฒนธรรม',
            'description' => '',
        ]);
        Workload::create([
            'name' => 'ภาระงานอื่นๆ ที่สอดคล้องกับพันธกิจของคณะ และมหาวิทยาลัย',
            'description' => '',
        ]);
    }
}
