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
       // create_orders_table.php

Schema::create('orders', function (Blueprint $table) {
    $table->id();

    $table->foreignId('showroom_id')->constrained()->cascadeOnDelete();
    $table->foreignId('customer_id')->constrained()->restrictOnDelete();

    $table->string('order_number')->unique();

    $table->enum('order_type', ['ready', 'commission']);

    $table->enum('status', [
        'new',
        'confirmed',
        'in_manufacturing',
        'ready',
        'delivered',
        'cancelled'
    ])->default('new');

    $table->enum('payment_status', [
        'unpaid',
        'partial',
        'paid',
        'refunded'
    ])->default('unpaid');

    $table->decimal('subtotal', 12, 2);
    $table->decimal('discount', 12, 2)->default(0);
    $table->decimal('total', 12, 2);

    $table->decimal('paid_amount', 12, 2)->default(0);
    $table->decimal('remaining_amount', 12, 2)->default(0);

    $table->date('expected_delivery_date')->nullable();
    $table->dateTime('delivered_at')->nullable();

    $table->text('notes')->nullable();

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
