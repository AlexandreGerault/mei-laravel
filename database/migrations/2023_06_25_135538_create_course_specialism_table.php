<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_specialism', static function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Course::class);
            $table->foreignIdFor(Specialism::class);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_specialism');
    }
};
