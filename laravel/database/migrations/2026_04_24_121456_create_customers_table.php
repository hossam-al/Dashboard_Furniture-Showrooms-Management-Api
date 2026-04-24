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
        // create_customers_table.php

        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('showroom_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            // 🔥 مهم جدًا للفلترة والبحث في الـ customers
            $table->index('showroom_id');
            $table->index('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
