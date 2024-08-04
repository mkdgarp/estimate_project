<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubworkloadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * RUN :: php artisan db:seed --class=SubworkloadsTableSeeder
     */
    public function run()
    {
        DB::table('subworkloads')->insert([
            ['id' => 1, 'name' => '๑.๑ ภาระงานสอนทฤษฎีเฉพาะภาคปกติ', 'description' => NULL, 'workload_id' => 1, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
            ['id' => 2, 'name' => '๑.๒ ภาระงานสอนปฏิบัติฉพาะภาคปกติ', 'description' => NULL, 'workload_id' => 1, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
            ['id' => 3, 'name' => '๑.๓ การดูแลนักศึกษารายวิชาฝึกงาน สหกิจศึกษา ฝึกประสบการณ์วิชาชีพครู โครงการ และวิชาอื่นที่ไม่ปรากฏเวลาในตารางสอน', 'description' => NULL, 'workload_id' => 1, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
            ['id' => 4, 'name' => '2.1 ทดสอบข้อย่อย 1', 'description' => NULL, 'workload_id' => 2, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
            ['id' => 5, 'name' => '2.2 ทดสอบข้อย่อย 2', 'description' => NULL, 'workload_id' => 2, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
            ['id' => 6, 'name' => '๑.๔ ภาระงานการเป็นที่ปรึกษาปัญหา พิเศษวิชาโครงการ/โครงงาน (เพื่อสำเร็จ การศึกษา)/วิทยานิพนธ์ การศึกษาเฉพาะ เรื่อง สารนิพนธ์/การค้นคว้าอิสระ/ปริญญา นิพนธ์ ศิลปนิพนธ์ ', 'description' => NULL, 'workload_id' => 1, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
            ['id' => 7, 'name' => '๑.๕ การจัดการเรียนการสอนโดยวิธีการอื่นๆ', 'description' => NULL, 'workload_id' => 1, 'created_at' => '2024-07-29 00:44:00', 'updated_at' => '2024-07-29 00:44:00'],
        ]);
    }
}
