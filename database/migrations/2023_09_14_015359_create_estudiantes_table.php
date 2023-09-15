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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Tipo de dato string
            $table->integer('edad');  // Tipo de dato integer
            $table->integer('grado');  // Tipo de dato integer
            $table->decimal('promedio', 5, 2); // Tipo de dato decimal (5 dígitos en total, 2 decimales)
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
        Schema::dropIfExists('estudiantes');
    }
};
