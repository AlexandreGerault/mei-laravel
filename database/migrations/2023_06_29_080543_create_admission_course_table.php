<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shared\Infrastructure\Laravel\Eloquent\Models\Admission;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_course', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Admission::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Course::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_course');
    }
};
