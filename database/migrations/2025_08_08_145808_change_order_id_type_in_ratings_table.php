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
        //  Schema::table('ratings', function (Blueprint $table) {
        //     // 1. Drop foreign key lama
        //     $table->dropForeign('ratings_order_id');
        // });

        // 2. Ubah tipe kolom ke char(36) agar sama dengan orders.order_id
        Schema::table('ratings', function (Blueprint $table) {
            // $table->char('order_id', 36)->change();
            $table->uuid('order_id')->change();
        });

        // 3. Tambah foreign key baru
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('order_id', 'ratings_order_id')
                  ->references('order_id')
                  ->on('orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_order_id');
            $table->bigInteger('order_id')->unsigned()->change();
        });
    }
};
