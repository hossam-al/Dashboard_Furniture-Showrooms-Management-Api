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
        // create_plans_table.php

        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('type', ['weekly', 'monthly', 'yearly']);
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('duration_days');
            $table->json('features')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
