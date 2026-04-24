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
        // create_products_table.php

        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('showroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();

            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();

            $table->enum('product_type', ['ready', 'commission']);

            $table->decimal('base_price', 12, 2);
            $table->decimal('final_price', 12, 2);
            $table->decimal('total_cost', 12, 2)->default(0);

            $table->unsignedInteger('quantity')->default(1);

            $table->enum('status', [
                'draft',
                'published',
                'reserved',
                'sold',
                'unavailable'
            ])->default('draft');

            $table->enum('manufacturing_status', [
                'not_required',
                'pending',
                'in_progress',
                'completed',
                'delayed'
            ])->default('not_required');

            $table->timestamps();

            $table->unique(['showroom_id', 'slug']);
            $table->index('showroom_id');
            $table->index('category_id');
            $table->index('product_type');
            $table->index('status');
            $table->index('manufacturing_status');

            // 🔥 composite index مهم جدًا
            $table->index(['showroom_id', 'product_type']);
            $table->index(['showroom_id', 'status']);
            $table->index(['category_id', 'product_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
