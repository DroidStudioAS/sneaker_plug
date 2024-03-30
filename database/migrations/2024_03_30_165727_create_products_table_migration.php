<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_table_migration', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("category_id");

            $table->foreign("category_id")
                ->references("id")
                ->on("product_categories")
                ->onDelete("restrict");

            $table->float("price");
            $table->string("description",220);
            $table->integer("available_amount");
            $table->string("image_name");

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
        Schema::dropIfExists('products_table_migration');
    }
}
