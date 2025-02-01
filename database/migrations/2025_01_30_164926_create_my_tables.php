<?php

use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

//use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->text('caption')->nullable();
            $table->unsignedBigInteger('autor_id');
            $table->timestamps();
            $table->foreign('autor_id')->references('id')->on('users');
        });

        Schema::create("tags", function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('image_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('image_id');

            $table->primary(['tag_id', 'image_id']);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->tinyInteger('value');
            $table->timestamp('updated_at')->useCurrent();

            $table->primary(['user_id', 'image_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });

        Schema::create('favs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->timestamp('f_date')->useCurrent();

            $table->primary(['user_id', 'image_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade'); //Mozno by nemusel byt cascade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('favs');
        Schema::dropIfExists('image_tags');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('images');
    }
};
