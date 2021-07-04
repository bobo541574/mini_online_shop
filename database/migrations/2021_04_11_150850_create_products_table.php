<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('name_en');
            $table->string('name_mm');
            $table->string('slug');
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('admin_choice')->nullable();
            $table->unsignedInteger('popular')->default(0);
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
        Schema::dropIfExists('products');
    }
}
