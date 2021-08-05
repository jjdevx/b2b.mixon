<?php

use App\Models\Department;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up(): void
    {
        $types = array_keys(Department::$types);

        Schema::create('departments', function (Blueprint $table) use ($types) {
            $table->id();

            $table->string('name');
            $table->enum('type', $types);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objects');
    }
}
