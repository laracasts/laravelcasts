<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('tagline');
            $table->text('description');
            $table->string('image');
            $table->json('learnings');
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
        });
    }
};
