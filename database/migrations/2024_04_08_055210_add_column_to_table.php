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
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->after('remember_token')->nullable();
            $table->string('phone')->after('full_name')->nullable();
            $table->date('birthdate')->after('phone')->nullable();
            $table->unsignedBigInteger('gender_type')->nullable()->after('birthdate');
            $table->unsignedBigInteger('city_type')->nullable()->after('gender_type');
            $table->unsignedBigInteger('country_type')->nullable()->after('city_type');
            $table->text('address')->nullable()->after('country_type');
            $table->tinyInteger('is_active')->default(1)->comment('0->de-active, 1->active')->after('address')->nullable();
            $table->unsignedBigInteger('user_type')->after('is_active');
            $table->text('media_id')->after('user_type')->nullable();

            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->text('uuid')->after('updated_by')->nullable();

            // foreign-key-reference-on-table

            $table->foreign('user_type')->references('id')->on('user_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
