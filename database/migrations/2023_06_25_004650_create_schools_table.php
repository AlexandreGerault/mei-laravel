<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique()->index();
            $table->string('logo');
            $table->longText('long_description');
            $table->string('short_description');
            $table->string('website');
            $table->string('city');
            $table->string('address');
            $table->string('region');
            $table->string('department');
            $table->boolean('is_public');
            $table->integer('foundation_year');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
