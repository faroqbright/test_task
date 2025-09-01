<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('sg')->create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('registration_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            $table->fullText(['name', 'slug', 'registration_number']);
        });


        Schema::connection('sg')->create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::connection('sg')->dropIfExists('reports');
        Schema::connection('sg')->dropIfExists('companies');
    }
};
