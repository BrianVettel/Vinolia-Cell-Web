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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('ticket', 10);
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('SET NULL');
            $table->text('address');
            $table->foreignId('device_issue_id')->constrained('device_issues');
            $table->string('issue_description')->nullable();
            $table->foreignId('device_brand_id')->constrained('device_brands');
            $table->string('status', 10)->nullable();
            $table->integer('price')->nullable();
            $table->text('price_detail')->nullable();
            $table->date('suggested_return_date')->nullable();
            $table->time('suggested_return_time')->nullable();
            $table->date('return_date');
            $table->time('return_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
