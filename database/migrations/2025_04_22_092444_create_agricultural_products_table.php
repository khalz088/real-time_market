<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('agricultural_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->text('description');
            $table->string('measurement_unit');
            $table->boolean('seasonal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agricultural_products');
    }
};
