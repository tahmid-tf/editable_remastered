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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('users_email');
            $table->string('users_phone');
            $table->string('users_name')->nullable()->default("Created By Admin");
            $table->enum('order_type', ['standard', 'express', 'custom']);
            $table->string('order_name');
            $table->string('category_name');
            $table->enum('payment_status', ['pending', 'successful', 'failed'])->default('pending');

            //            sorting from orders table

            $table->timestamp('order_date')->nullable();
            $table->string('order_id')->nullable();
            $table->string('amount');
            $table->string('editors_id')->nullable();
            $table->enum('order_status', ['pending', 'completed', 'cancelled', 'preview'])->default('pending');
            $table->string('file_uploaded_by_user')->nullable();
            $table->string('file_uploaded_by_admin_after_edit')->nullable();

            //            styles information --- from here

            $table->string('styles')->nullable();
            $table->integer('number_of_images_provided')->nullable();
            $table->enum('culling', ['yes', 'no'])->nullable()->default('no');
            $table->string('images_culled_down_to')->nullable();
            $table->string('select_image_culling_type')->nullable();

            $table->enum('skin_retouching', ['yes', 'no'])->nullable()->default('no');
            $table->string('skin_retouching_type')->nullable();
            $table->string('no_of_skin_retouch_items')->nullable();

            $table->enum('additional_info', ['yes', 'no'])->nullable()->default('no');
            $table->enum('preview_edits', ['yes', 'no'])->nullable()->default('no');

//            Users Info
            $table->string('user_id')->nullable();

            $table->timestamp('order_delivery_date')->nullable();
            $table->enum('preview_edit_status', ['no', 'user_review_pending', 'accepted', 'rejected'])->nullable()->default('no');



            $table->timestamps();
            $table->softDeletes();
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
