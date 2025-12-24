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
    Schema::create('transaction_details', function (Blueprint $table) {
        $table->id();
        
        // Foreign Key ke transactions
        $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
        
        // Foreign Key ke games (hanya referensi)
        $table->foreignId('game_id')->constrained('games');
        
        // Foreign Key ke products (hanya referensi)
        $table->foreignId('product_id')->constrained('products');
        
        // Snapshot Data (PENTING)
        $table->string('product_name_snapshot');
        $table->decimal('price_snapshot', 10, 2);
        
        // User Input
        $table->string('target_uid');
        $table->string('target_zone')->nullable();
        
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
        Schema::dropIfExists('transaction_details');
    }
};
