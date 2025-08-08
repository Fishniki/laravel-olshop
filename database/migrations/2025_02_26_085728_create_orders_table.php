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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id')->unique();
            $table->json('jumlah_order');
            $table->json('harga_peritem');
            $table->json('pakaian_id');
            $table->bigInteger('total_order');
            $table->enum('status', ['Unpaid', 'Paid', 'Shipped', 'Delivered','Finished', 'Canceled', 'Ratings'])->default('Unpaid');
            $table->foreignId('alamat_id')->constrained(
                table:'alamats',
                indexName:'order_alamat_id'
            )->onDelete('cascade');
            $table->foreignId('user_id')->constrained(
                table:'users',
                indexName:'order_user_id'
            )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
