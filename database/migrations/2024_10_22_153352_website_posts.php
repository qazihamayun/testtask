<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('website_id');
            $table->string('title');
            $table->string('title_slug')->nullable();
            $table->text('description');
            $table->enum('status',['draft', 'published','unpublished'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_posts');
    }
};
