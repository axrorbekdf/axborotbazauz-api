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
        // Categories jadvali
        Schema::table('categories', function (Blueprint $table) {
            $table->index('name');
        });

        // Products jadvali
        Schema::table('subjects', function (Blueprint $table) {
            $table->index('name');
        });

        // Users jadvali
        Schema::table('materials', function (Blueprint $table) {
            $table->index('title');
            $table->index('category_id');
            $table->index('subject_id');
        });

        // // Users jadvali
        // Schema::table('material_pages', function (Blueprint $table) {
        //     $table->index('content');
        //     $table->index('material_id');
        // });

        // Users jadvali
        Schema::table('payments', function (Blueprint $table) {
            $table->index('name');
        });

        // Users jadvali
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->index('name');
            $table->index('price');
            $table->index('period');
        });


        // Users jadvali
        Schema::table('subscription_histories', function (Blueprint $table) {
            $table->index('start_date');
            $table->index('end_date');
            $table->index("user_id");
            $table->index("subscription_id");
            $table->index("payment_id");
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        // Categories jadvali
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });

        // // Products jadvali
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });

        // // Users jadvali
        Schema::table('materials', function (Blueprint $table) {
            $table->dropIndex(['title']);
        });

        // Users jadvali
        Schema::table('material_pages', function (Blueprint $table) {
            $table->dropIndex(['content']);
        });

        // Users jadvali
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });

        // Users jadvali
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['price']);
            $table->dropIndex(['period']);
        });


        // Users jadvali
        Schema::table('subscription_histories', function (Blueprint $table) {
            $table->dropIndex(['start_date']);
            $table->dropIndex(['end_date']);
        });
        
    }
};
