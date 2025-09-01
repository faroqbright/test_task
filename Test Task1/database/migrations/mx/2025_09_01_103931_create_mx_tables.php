<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('mx')->create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


        Schema::connection('mx')->create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('state_id');
            $table->string('slug')->nullable();
            $table->string('registration_number')->nullable();

            $table->timestamps();
            $table->fullText(['name', 'slug', 'registration_number']);
        });


        Schema::connection('mx')->create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });


        Schema::connection('mx')->create('report_state', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('report_id');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::connection('mx')->dropIfExists('report_state');
        Schema::connection('mx')->dropIfExists('reports');
        Schema::connection('mx')->dropIfExists('companies');
        Schema::connection('mx')->dropIfExists('states');
    }
};




