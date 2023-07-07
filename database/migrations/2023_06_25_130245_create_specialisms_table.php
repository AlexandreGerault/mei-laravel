<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialisms', static function (Blueprint $table) {
            $table->ulid('id', 16)->charset('binary')->primary();
            $table->foreignIdFor(Discipline::class)->charset('binary')->nullable();
            $table->foreignIdFor(School::class)->charset('binary')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialisms');
    }
};
