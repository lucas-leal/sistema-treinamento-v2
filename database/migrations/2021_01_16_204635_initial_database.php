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
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('title');
            $table->string('description', 100);
            $table->string('instructor');
            $table->string('keywords');
            $table->foreignUuid('category_id')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
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

        Schema::create('views', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('video_id')->references('id')->on('videos');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('path');
            $table->foreignUuid('unit_id')->references('id')->on('units');
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['inactive', 'active'])->default('inactive');
            $table->string('title');
            $table->foreignUuid('unit_id')->references('id')->on('units');
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

        Schema::create('registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('course_id')->references('id')->on('courses');
            $table->timestamps();
        });

        Schema::create('resolutions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('activity_id')->references('id')->on('activities');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('resolution_id')->references('id')->on('resolutions');
            $table->foreignUuid('question_id')->references('id')->on('questions');
            $table->foreignUuid('option_id')->references('id')->on('options');
            $table->timestamps();
        });

        Schema::create('evaluations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('score');
            $table->string('comment');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('course_id')->references('id')->on('courses');
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
        Schema::dropIfExists('evaluations');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('resolutions');
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('files');
        Schema::dropIfExists('views');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('units');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('categories');
    }
}
