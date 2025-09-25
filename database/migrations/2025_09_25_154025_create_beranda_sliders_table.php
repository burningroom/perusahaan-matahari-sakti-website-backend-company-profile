<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beranda_sliders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('media');
            $table->string('title');
            $table->text('description');
            $table->integer('sort_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beranda_sliders');
    }
};
