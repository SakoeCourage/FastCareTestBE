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
        Schema::create('payment_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("subscriber");
            $table->string("mid");
            $table->bigInteger("amount");
            $table->string("status")->comment("paid or pending");
            $table->foreignId("payment_id")->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_lists');
    }
};
