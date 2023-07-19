<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shared\Infrastructure\Laravel\Eloquent\Models\Industry;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('industry_specialism', static function (Blueprint $table) {
            //            $table->ulid('id', 16)->charset('binary')->primary();
            $table->foreignIdFor(Industry::class)->charset('binary')->nullable();
            $table->foreignIdFor(Specialism::class)->charset('binary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industry_specialism');
    }
};
