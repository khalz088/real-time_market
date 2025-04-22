<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('market_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agricultural_product_id')->constrained('agricultural_products');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');            $table->decimal('wholesale_price')->nullable();
            $table->decimal('retail_price')->nullable();
            $table->decimal('quantity_available')->default(0);
            $table->boolean('is_organic')->default(true);
            $table->string('price_trend')->nullable();
            $table->decimal('price_change_percent');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('market_prices');
    }
};
