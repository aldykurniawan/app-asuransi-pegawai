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
        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number');
            $table->string('policy_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('coverage_amount')->default(0);
            $table->float('premium_amount')->default(0);
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade')->before('created_at');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade')->after('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_policies');
    }
};
