<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_seo', function (Blueprint $table) {
            $table->id();
            $table->string('halaman');
            $table->string('judul');
            $table->string('meta_keyword');
            $table->text('meta_description');
            $table->string('gambar');
            $table->string('url');
            $table->string('site_name');
            $table->dateTime('published_time')->nullable();
            $table->dateTime('modified_time')->nullable();
            $table->string('robots');
            $table->string('author');
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
        Schema::dropIfExists('pengaturan_seo');
    }
};
