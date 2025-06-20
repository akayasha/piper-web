<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('redeem_code_id')->nullable();  
            $table->string('invoice_number')->unique();
            $table->string('transaction_id')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('strip');
            $table->enum('status', ['success' , 'pending', 'expired']);
            $table->string('payment_method')->nullable();
            $table->timestamps();
            $table->foreign('redeem_code_id')
                ->references('id')
                ->on('redeem_codes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
