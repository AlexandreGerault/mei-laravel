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
            //            $table->ulid('id', 16)->charset('binary')->primary();

            $table->foreignIdFor(Admission::class)
                ->charset('binary');

            $table->foreignIdFor(Course::class)
                ->charset('binary');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_course');
    }
};
