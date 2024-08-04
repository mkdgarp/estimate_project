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
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('subworkload_id');
            $table->decimal('factor')->default(1);
            $table->integer('sort_order')->default(1);
            $table->integer('is_child')->default(0);
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
