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
        Schema::create('tbl_wips', function (Blueprint $table) {
            $table->id();
            $table->string('no_claimex')->nullable();
            $table->string('type_doit')->nullable();
            $table->string('respon_name')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_stop')->nullable();
            $table->decimal('price_doit',10,2)->default(0.00);
            $table->integer('num_work')->default(0);
            $table->decimal('cal_doit')->default(0.00);
            $table->integer('user_create')->default(0);
            $table->integer('user_update')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_wips');
    }
};
