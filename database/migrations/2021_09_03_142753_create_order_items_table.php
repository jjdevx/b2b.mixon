<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('good_id')->constrained()->onDelete('cascade');

            $table->unsignedTinyInteger('qty');
            $table->decimal('price');
            $table->decimal('weight', 7, 3)->nullable();
            $table->decimal('volume', 6)->nullable();

            $table->primary(['order_id', 'good_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
}
