<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admissions', static function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignIdFor(Pathway::class, 'pathway_id')
                ->charset('binary')
                ->nullable();

            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
