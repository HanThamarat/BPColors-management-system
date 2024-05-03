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
        Schema::create('tbl_stock_ins', function (Blueprint $table) {
            $table->id();
            $table->string('stock_id')->nullable();
            $table->string('stock_name_doc')->nullable();
            $table->date('date_stock_in')->nullable();
            $table->integer('num_in')->nullable();
            $table->string('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_stock_ins');
    }
};
