<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['active', 'inactive']);
            $table->string('name');
            $table->string('instructor');
            $table->json('keywords');
            $table->foreignUuid('category_id')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignUuid('course_id')->references('id')->on('courses');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('url');
            $table->foreignUuid('unit_id')->references('id')->on('units');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('path');
            $table->foreignUuid('unit_id')->references('id')->on('units')->nullable(true);
            $table->foreignUuid('course_id')->references('id')->on('courses');
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['inactive', 'active'])->default('inactive');
            $table->string('title');
            $table->foreignUuid('unit_id')->references('id')->on('units')->nullable(true);
            $table->foreignUuid('course_id')->references('id')->on('courses');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('description');
            $table->foreignUuid('activity_id')->references('id')->on('activities');
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('description');
            $table->boolean('correct')->default(false);
            $table->foreignUuid('question_id')->references('id')->on('questions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('files');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('units');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('categories');
    }
}
