<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();

            $table->decimal('style_price', 8, 2);
            $table->string('style_threshold');

            $table->decimal('culling_price', 8, 2);
            $table->string('culling_threshold');

            $table->decimal('skin_retouch_price', 8, 2);
            $table->string('skin_retouch_threshold');

            $table->decimal('preview_edit_price', 8, 2);
            $table->string('preview_edit_threshold');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
