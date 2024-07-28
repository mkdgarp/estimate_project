<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin'])->default('user'); // เพิ่ม role และตั้งค่า default เป็น 'user'
            $table->enum('rank', ['0', '1', '2', '3', '4', '5', '6'])->default('1'); 
            //0 = ไม่มี,ผู้ดูแลระบบ (ผู้ดูแลระบบ จะถูกยกเว้นจากการตรวจสอบระดับ rank จึงตั้งค่าพื้นฐานเป็น 0)
            //1 = เจ้าหน้าที่
            //2 = อาจารย์
            //3 = หัวหน้าหลักสูตร
            //4 = หัวหน้าสาขา
            //5 = ผู้ช่วยคณบดี
            //6 = รองคณบดี
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('rank');
        });
    }
};
