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
        Schema::create('social', function (Blueprint $table) {
            $table->id();
            $table->enum('social',
                ['Facebook', 'Instagran', 'X', 'Linkedin', 'Other']);
            $table->string('url')->nullable();
            $table->unsignedInteger('restaurant_id');
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social');
    }
};
