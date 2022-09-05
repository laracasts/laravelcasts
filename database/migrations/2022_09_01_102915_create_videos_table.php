<?php

use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class);
            $table->string('slug');
            $table->string('vimeo_id');
            $table->string('title');
            $table->text('description');
            $table->integer('duration_in_min');
            $table->timestamps();
        });
    }
};
