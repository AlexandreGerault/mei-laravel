<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pathways', static function (Blueprint $table) {
            $table->ulid('id', 16)->charset('binary')->primary();
            $table->string('name');
            $table->string('description');
            $table->integer('post_bac_level')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pathways');
    }
};
