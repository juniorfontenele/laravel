<?php

use App\Models\Tenant;
use App\Models\User;
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
        $usersTable = app(User::class)->getTable();
        $tenantTable = app(Tenant::class)->getTable();

        Schema::create('tenants', function (Blueprint $table) use ($usersTable) {
            $table->id();
            $table->string('name')->unique();
            $table->json('data')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained($usersTable)->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('tenant_hosts', function (Blueprint $table) use ($usersTable) {
            $table->id();
            $table->string('host')->unique();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained($usersTable)->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('tenant_user', function (Blueprint $table) use ($usersTable, $tenantTable) {
            $table->id();
            $table->foreignId('tenant_id')->constrained($tenantTable)->cascadeOnDelete();
            $table->foreignId('user_id')->constrained($usersTable)->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained($usersTable)->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
        Schema::dropIfExists('tenant_hosts');
        Schema::dropIfExists('tenant_user');
    }
};
