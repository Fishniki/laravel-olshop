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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->text('comment');
            $table->text('image');
            $table->foreign('order_id')
            ->references('order_id')
            ->on('orders')
            ->onDelete('cascade');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'rating_user_id'
            )->onDelete('cascade');
            $table->foreignId('product_id')->constrained(
                table: 'pakaians',
                indexName: 'rating_product_id'
            )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
