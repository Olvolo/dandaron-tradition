<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('placements', function (Blueprint $table) {
            $table->string('background_image_url')->nullable()->after('show_on_main');
            $table->text('custom_styles')->nullable()->after('background_image_url');
        });
    }

    public function down(): void
    {
        Schema::table('placements', function (Blueprint $table) {
            $table->dropColumn(['background_image_url', 'custom_styles']);
        });
    }
};
