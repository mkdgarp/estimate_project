<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_subworkloads', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('subworkload_id');
            $table->decimal('factor',8,3)->default(1.000);
            $table->string('create_by')->default('SYSTEM');
            $table->integer('sort_order')->default(0);
            $table->integer('is_child')->default(0);
            $table->integer('is_unique')->default(0); //ซับซ้อนหรือไม่ เช่น นอก/ในประเทศ,หัวหน้า/ผู้ร่วม ? 0=ไม่ 1=ใช่จ้า
            $table->integer('is_leader')->default(0); //หัวหน้าหรือไม่ ? 0=ไม่
            $table->integer('is_country')->default(0); //ต่างประเทศหรือไม่ ? 0=ไม่
            $table->unsignedBigInteger('list_subworkloads_child_id')->nullable();
            
            $table->timestamps();
            
            // $table->foreign('list_subworkloads_child_id')->references('id')->on('list_subworkloads')->onDelete('cascade');
            // $table->foreign('subworkload_id')->references('id')->on('subworkloads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_subworkloads');
    }
};
