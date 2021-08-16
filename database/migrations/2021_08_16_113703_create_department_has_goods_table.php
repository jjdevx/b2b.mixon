<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentHasGoodsTable extends Migration
{
    public function up(): void
    {
        Schema::create('department_has_goods', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();

            $table->string('sku');
            $table->unsignedSmallInteger('qty');

            $table->foreign('sku')->references('sku')->on('goods')->cascadeOnDelete();
            $table->primary(['department_id', 'sku']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department_has_goods');
    }
}
