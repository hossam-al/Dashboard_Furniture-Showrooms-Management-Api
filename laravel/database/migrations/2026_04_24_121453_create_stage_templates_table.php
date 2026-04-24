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
       // create_stage_templates_table.php

Schema::create('stage_templates', function (Blueprint $table) {
    $table->id();

    $table->foreignId('category_id')->constrained()->cascadeOnDelete();

    $table->string('name');
    $table->unsignedInteger('sort_order')->default(1);
    $table->boolean('is_required')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_templates');
    }
};
