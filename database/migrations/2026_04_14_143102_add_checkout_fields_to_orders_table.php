<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->nullable()->after('id');
            $table->string('customer_name')->nullable()->after('user_id');
            $table->string('email')->nullable()->after('customer_name');
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('city')->nullable()->after('address');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('payment_method')->default('COD')->after('postal_code');

            // ✅ TAMBAHAN UNTUK STATISTIK
            $table->string('type')->default('reguler')->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_number',
                'customer_name',
                'email',
                'phone',
                'address',
                'city',
                'postal_code',
                'payment_method',
                'type', // ✅ jangan lupa ini juga dihapus saat rollback
            ]);
        });
    }
};