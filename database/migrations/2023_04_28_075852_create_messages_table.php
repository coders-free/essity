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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->string('pharmacy_name');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('province');
            $table->string('phone');
            $table->string('nif_1');
            $table->string('nif_2')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('email');

            $table->boolean('responded')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
