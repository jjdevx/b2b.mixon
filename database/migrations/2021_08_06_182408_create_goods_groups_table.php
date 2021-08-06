<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsGroupsTable extends Migration
{
    public function up(): void
    {
        Schema::create('goods_groups', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_groups');
    }
}
