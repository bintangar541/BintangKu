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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        // Foreign Key ke games
        $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
        
        $table->string('name');
        $table->string('sku')->unique(); // Stock Keeping Unit
        $table->decimal('price_modal', 10, 2); // 10 digit, 2 desimal
        $table->decimal('price_sell', 10, 2);
        $table->integer('stock')->nullable(); // Nullable jika unlimited
        $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('products');
    }
};
