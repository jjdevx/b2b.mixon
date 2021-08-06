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

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_categories');
    }
}
