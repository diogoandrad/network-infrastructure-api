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
        Schema::create('devices', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->ulid('network_id');
            $table->foreign('network_id')
                ->references('id')
                ->on('networks')
                ->cascadeOnDelete();
            
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('ip_addresses');
            $table->string('mac_address', 17)->unique();

            $table->enum('device_type', [
                'router',
                'switch',
                'server',
                'firewall',
                'workstation',
                'other'
            ]);
            
            $table->string('os')->nullable();
            $table->enum('status', ['online', 'offline'])->default('offline');

            $table->timestamps();

            $table->index('device_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
