<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->string('slug');
            $table->string('photo');
            $table->string('sku')->default(0);
            $table->decimal('extra_cost', 5, 2)->default(0);
            $table->decimal('delivery_cost', 5, 2)->default(0);
            $table->decimal('buy_price', 8, 2)->default(0);
            $table->decimal('sale_price', 8, 2)->default(0);
            $table->decimal('promotion', 3, 2)->default(0);
            $table->tinyInteger('active')->default(0);
            $table->date('arrived', 0);
            $table->text('description_en');
            $table->text('description_mm');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
