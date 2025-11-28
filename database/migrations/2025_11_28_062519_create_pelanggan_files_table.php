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
            Schema::create('pelanggan_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pelanggan_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('original_name');
            $table->string('file_size');
            $table->string('file_type');
            $table->timestamps();

            $table->foreign('pelanggan_id')
                  ->references('pelanggan_id')
                  ->on('pelanggan')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan_files');
    }
};
