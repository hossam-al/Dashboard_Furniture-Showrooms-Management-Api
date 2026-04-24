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
        // create_payments_table.php

        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->decimal('amount', 12, 2);

            $table->enum('payment_method', [
                'cash',
                'bank_transfer',
                'wallet',
                'card'
            ])->default('cash');

            $table->enum('payment_type', [
                'deposit',
                'installment',
                'full_payment'
            ])->default('deposit');

            $table->dateTime('paid_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
