<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_code')->unique(); // INV-YYYYMMDD-XXXX
        $table->string('customer_contact')->nullable(); // Email/WA
        
        // Foreign Key ke payment_methods
        $table->foreignId('payment_method_id')->constrained('payment_methods');
        
        $table->decimal('total_amount', 12, 2);
        // Status: pending, paid, failed, expired
        $table->enum('status', ['pending', 'paid', 'failed', 'expired'])->default('pending');
        
        $table->timestamp('paid_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
