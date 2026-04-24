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
        // create_product_stages_table.php

        Schema::create('product_stages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stage_template_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->unsignedInteger('sort_order')->default(1);

            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'delayed',
                'skipped'
            ])->default('pending');

            $table->date('start_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->decimal('cost', 12, 2)->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stages');
    }
};
