<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_stock_outs', function (Blueprint $table) {
            $table->id();
            $table->string('id_doc')->nullable();
            $table->string('stock_id')->nullable();
            $table->integer('num_out')->default(0);
            $table->string('car_use')->nullable();
            $table->string('name_out_use')->nullable();
            $table->date('date_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_stock_outs');
    }
};
