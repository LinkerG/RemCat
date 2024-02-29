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
        Schema::create('insurances', function (Blueprint $table) {
            //Comentado ya que mongoDB crea el id automaticamente
            //$table->increments("_id");
            $table->string("cif");
            $table->string("name");
            $table->string("address");
            $table->number("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
