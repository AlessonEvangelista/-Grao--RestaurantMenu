<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurant', function (Blueprint $table) {
            $table->id();
            $table->string('fantasy_name');
            $table->string('company_name')
                ->nullable();
            $table->string('identification_doc');
            $table->string('describe')
                ->nullable();
            $table->string('address');
            $table->string('opening_hours')
                ->default('Seg. a Sex. das 11:00 às 15:00hrs e das 19:00 às 00:00hrs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant');
    }
};
