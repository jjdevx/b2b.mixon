<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('goods_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('goods_groups')->onDelete('cascade');

            $table->string('name');
            $table->unsignedSmallInteger('number');

            $table->decimal('sale_small', 4)->nullable();
            $table->decimal('sale_medium', 4)->nullable();
            $table->decimal('sale', 4)->nullable();
            $table->decimal('sale_special', 4)->nullable();
            $table->decimal('sale_big', 4)->nullable();
            $table->decimal('sale_exclusive', 4)->nullable();
            $table->decimal('sale_super_exclusive', 4)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_categories');
    }
}
