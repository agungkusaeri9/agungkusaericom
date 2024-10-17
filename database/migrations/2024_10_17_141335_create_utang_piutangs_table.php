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
        Schema::create('utang_piutang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('jumlah');
            $table->enum('jenis', ['utang', 'piutang']);
            $table->string('keterangan')->nullable();
            $table->string('kepada');
            $table->date('tanggal_jatuh_tempo');
            $table->boolean('status');
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
        Schema::dropIfExists('utang_piutang');
    }
};
