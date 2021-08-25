<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasSalesTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_has_sales', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('goods_categories')->onDelete('cascade');

            $table->decimal('size', 4);

            $table->primary(['user_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_has_sales');
    }
}
