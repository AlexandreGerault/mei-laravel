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
            $table->id();
            $table->foreignIdFor(Industry::class)->nullable();
            $table->foreignIdFor(Specialism::class)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industry_specialism');
    }
};
