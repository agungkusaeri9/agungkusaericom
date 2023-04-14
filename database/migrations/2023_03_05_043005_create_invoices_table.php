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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('payment_id')->constrained('payments')->nullable();
            $table->bigInteger('sub_total');
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('total');
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
        Schema::dropIfExists('invoices');
    }
};
