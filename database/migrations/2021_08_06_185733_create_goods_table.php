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

            $table->decimal('volume', 6)->nullable();
            $table->decimal('weight', 7, 3)->nullable();

            $table->timestamps();

            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
}
