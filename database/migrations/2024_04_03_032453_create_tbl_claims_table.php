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
        Schema::create('tbl_claims', function (Blueprint $table) {
            $table->id();
            $table->string('no_claim', 100)->nullable();
            $table->string('no_policy', 100)->nullable();
            $table->string('no_job', 100)->nullable();
            $table->string('cus_name')->nullable();
            $table->string('cus_tel', 10)->nullable();
            $table->string('no_regiscar', 100)->nullable();
            $table->string('car_brand')->nullable();
            $table->string('car_model')->nullable();
            $table->string('car_chassis')->nullable();
            $table->string('status_deduct')->nullable(0);
            $table->enum('status_color', ['0','1'])->default(0);
            $table->enum('deduct_claim', ['0','1'])->default(0);
            $table->string('car_type')->nullable();
            $table->string('car_job')->nullable();
            $table->string('insure_type')->nullable();
            $table->string('cus_resource')->nullable();
            $table->string('insure_source')->nullable();
            $table->string('payment_st')->nullable();
            $table->date('data_status')->nullable();
            $table->string('insure_name')->nullable();
            $table->date('date_cliam')->nullable();
            $table->date('date_repair')->nullable();
            $table->date('date_carin')->nullable();
            $table->date('date_firmins')->nullable();
            $table->date('date_service')->nullable();
            $table->date('date_send')->nullable();
            $table->date('date_send_next')->nullable();
            $table->date('date_dms')->nullable();
            $table->date('date_ecliam')->nullable();
            $table->date('date_fecliam')->nullable();
            $table->date('date_send_car')->nullable();
            $table->string('invice_no')->nullable();
            $table->string('bill_no')->nullable();
            $table->date('date_bill')->nullable();
            $table->date('date_paybill')->nullable();
            $table->date('date_transfer')->nullable();
            $table->decimal('const_doit',10,2)->default(0.00);
            $table->decimal('const_sparepart',10,2)->default(0.00);
            $table->decimal('const_totel',10,2)->default(0.00);
            $table->decimal('firm_doit',10,2)->default(0.00);
            $table->decimal('firm_sparepart',10,2)->default(0.00);
            $table->decimal('firm_all',10,2)->default(0.00);
            $table->decimal('total_pay',10,2)->default(0.00);
            $table->decimal('exzept',10,2)->default(0.00);
            $table->text('remark')->nullable();
            $table->text('note_service')->nullable();
            $table->string('job_status')->nullable();
            $table->date('date_create')->nullable();
            $table->date('date_update')->nullable();
            $table->integer('user_create');
            $table->integer('user_update');
            $table->string('user_con')->nullable();
            $table->string('user_emcs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_claims');
    }
};
