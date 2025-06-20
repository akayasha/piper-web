<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('redeem_codes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('branch_id');
            $table->string('code', 5)->unique();
            $table->enum('type', ['offline' , 'online']);
            $table->integer('strip');
            $table->boolean('is_redeemed')->default(false);
            $table->timestamp('redeemed_at')->nullable();
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redeem_codes');
    }
};
