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
        // create_subscriptions_table.php

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('showroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained()->restrictOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->enum('status', ['active', 'expired', 'pending', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid');

            $table->decimal('amount', 10, 2);
            // 🔥 مهم جدًا للفلترة والبحث في الـ subscriptions
            $table->index('showroom_id');
            $table->index('status');
            $table->index('end_date');

            // 🔥 لمعرفة الاشتراكات المنتهية
            $table->index(['showroom_id', 'status']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
