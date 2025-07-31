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
        Schema::create('placements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('placements')->onDelete('cascade');
            $table->string('title'); // Название пункта меню/раздела
            $table->string('slug');
            $table->integer('order_column')->default(0);

            // Полиморфная связь для ссылки на контент
            $table->nullableMorphs('placementable'); // Создаст placementable_id и placementable_type

            // Галочки для отображения
            $table->boolean('show_in_menu')->default(false);
            $table->boolean('show_on_main')->default(false);

            $table->timestamps();

            // Уникальный slug в рамках одного родителя
            $table->unique(['parent_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placements');
    }
};
