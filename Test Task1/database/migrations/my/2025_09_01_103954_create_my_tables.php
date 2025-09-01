<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('my')->create('company_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


        Schema::connection('my')->create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('company_type_id');
            $table->string('slug')->nullable();
            $table->string('registration_number')->nullable();
            $table->timestamps();

            $table->fullText(['name', 'slug', 'registration_number']);
        });


        Schema::connection('my')->create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_type_id');
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['enabled', 'disabled'])->default('enabled');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::connection('my')->dropIfExists('reports');
        Schema::connection('my')->dropIfExists('companies');
        Schema::connection('my')->dropIfExists('company_types');
    }
};
