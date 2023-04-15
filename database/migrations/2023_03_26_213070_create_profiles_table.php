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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('pharmacy_name');
            $table->string('address');
            
            $table->integer('cp');

            $table->foreignId('province_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('town_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('phone', 10);

            $table->string('nif_1', 9);
            $table->string('nif_2', 9);

            $table->integer('sap_number')->nullable();
            $table->integer('cmr_number')->nullable();

            $table->foreignId('cluster_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('delegate_id')
                ->nullable();
            $table->foreign('delegate_id')->references('id')->on('users');
            

            //geographic area
            $table->foreignId('geographic_area_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('max_orders_per_month')
                ->nullable();

            $table->boolean('unlimited')
                ->default(false);

            $table->string('sales_org')->default('ES68');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
