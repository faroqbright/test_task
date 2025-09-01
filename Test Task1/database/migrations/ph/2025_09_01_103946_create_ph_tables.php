<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('ph')->create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('registration_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            $table->fullText(['name', 'slug', 'registration_number']);
        });


        Schema::connection('ph')->create('report_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2); // base price per type
            $table->timestamps();
        });


        Schema::connection('ph')->create('report_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_type_id');
            $table->integer('pages')->nullable();
            $table->timestamps();
        });


        Schema::connection('ph')->create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('report_price_id');
            $table->date('period_date');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::connection('ph')->dropIfExists('reports');
        Schema::connection('ph')->dropIfExists('report_prices');
        Schema::connection('ph')->dropIfExists('report_types');
        Schema::connection('ph')->dropIfExists('companies');
    }
};
