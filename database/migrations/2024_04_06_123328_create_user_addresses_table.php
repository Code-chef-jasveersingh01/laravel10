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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('full_name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('address_type')->nullable();
            $table->unsignedBigInteger('city_type')->nullable();
            $table->unsignedBigInteger('state_type')->nullable();
            $table->unsignedBigInteger('country_type')->nullable();
            $table->string('zip_code')->nullable();
            $table->tinyInteger('is_default_address')->default(0)->comment('0->no, 1->yes');

            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
