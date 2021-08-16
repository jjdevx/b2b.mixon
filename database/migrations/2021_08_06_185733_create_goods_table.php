<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    public function up(): void
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('goods_categories')->onDelete('cascade');

            $table->string('sku');
            $table->string('name');

            $table->decimal('arp')->nullable();
            $table->decimal('rrp');

            $table->unsignedTinyInteger('wholesale_small')->nullable();
            $table->unsignedTinyInteger('wholesale_medium')->nullable();
            $table->unsignedTinyInteger('wholesale')->nullable();
            $table->unsignedTinyInteger('wholesale_special')->nullable();
            $table->unsignedTinyInteger('wholesale_big')->nullable();
            $table->unsignedTinyInteger('wholesale_exclusive')->nullable();
            $table->unsignedTinyInteger('wholesale_super_exclusive')->nullable();

            $table->decimal('volume', 6)->nullable();
            $table->decimal('weight', 6)->nullable();

            $table->timestamps();

            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
}
