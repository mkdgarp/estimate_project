<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListSubworkloadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * RUN :: php artisan db:seed --class=ListSubworkloadsTableSeeder
     */

    public function run()
    {
        DB::table('list_subworkloads')->insert([
            ['id' => 1, 'name' => '๑. ระดับปริญญาตรี /ปวส./ปวช./อนุปริญญา (หลักสูตรภาษาไทย)', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 0.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 1, 'list_subworkloads_child_id' => NULL],
            ['id' => 2, 'name' => '๒. ระดับปริญญาตรี /ปวส./ปวช./อนุปริญญา (หลักสูตรนานาชาติ (English Program))', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 3.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 3, 'name' => '๓. ระดับบัณฑิตศึกษา (หลักสูตรภาษาไทย)', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 3.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 4, 'name' => '๔. ระดับบัณฑิตศึกษา (หลักสูตรนานาชาติ)', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 3.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 5, 'name' => '๕. โครงการพิเศษทางบูรณาการของมหาวิทยาลัยทุกระดับ', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 3.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 6, 'name' => 'ภาระงานสอนปฏิบัติ ทุกระดับ/ทุกประเภท', 'description' => NULL, 'subworkload_id' => 2, 'factor' => 1.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 7, 'name' => '๑.๑ จำนวนนักศึกษาต่อหนึ่งห้องเรียนน้อยกว่า ๓๐ คน', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 2.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => 1],
            ['id' => 8, 'name' => '๑.๒ จำนวนบักศึกษาต่อหนึ่งห้องเรียน ๓๐ - ๖๐ คน', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 3.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => 1],
            ['id' => 9, 'name' => '๑.๓ จำนวนบักศึกษาต่อหนึ่งห้องเรียนมากกว่า ๖๐ คน', 'description' => NULL, 'subworkload_id' => 1, 'factor' => 4.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => 1],
            ['id' => 10, 'name' => 'นิเทศและประเมินผลการฝึกงาน/สหกิจศึกษา/การฝึกสอน (ต่อครั้ง) (นับได้ไม่เกิน 4 ครั้ง)', 'description' => NULL, 'subworkload_id' => 3, 'factor' => 1.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 11, 'name' => 'ผู้ประสานงาน (ผู้รับผิดชอบรายวิชา)', 'description' => NULL, 'subworkload_id' => 3, 'factor' => 3.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 12, 'name' => 'ปวช.	(นับได้ไม่เกิน 3 เรื่อง)', 'description' => NULL, 'subworkload_id' => 6, 'factor' => 2.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 13, 'name' => 'ปวส.	(นับได้ไม่เกิน 3 เรื่อง)', 'description' => NULL, 'subworkload_id' => 6, 'factor' => 2.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 14, 'name' => 'ปริญญาตรี	(นับได้ไม่เกิน 5 เรื่อง)', 'description' => NULL, 'subworkload_id' => 6, 'factor' => 2.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 15, 'name' => 'ปริญญาโท	(ให้เป็นไปตามหลักเกณฑ์มาตรฐานบัณฑิตศึกษา	)', 'description' => NULL, 'subworkload_id' => 6, 'factor' => 8.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 16, 'name' => 'ปริญญาเอก	(ให้เป็นไปตามหลักเกณฑ์มาตรฐานบัณฑิตศึกษา	)', 'description' => NULL, 'subworkload_id' => 6, 'factor' => 12.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
            ['id' => 17, 'name' => 'การทัศนศึกษา/ศึกษาดูงานที่ปรากฏในคำอธิบายรายวิชา ชั่วโมง/โครงการ (คิดไม่เกิน ๓ โครงการ)', 'description' => NULL, 'subworkload_id' => 7, 'factor' => 1.00, 'create_by' => 'SYSTEM','sort_order' => 0, 'created_at' => NULL, 'updated_at' => NULL, 'is_child' => 0, 'list_subworkloads_child_id' => NULL],
        ]);
    }
}
