<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->decimal('fine_amount', 10, 2)->default(0)->after('admin_notes');
            $table->boolean('fine_paid')->default(false)->after('fine_amount');
            $table->timestamp('fine_paid_at')->nullable()->after('fine_paid');
            $table->unsignedBigInteger('fine_confirmed_by')->nullable()->after('fine_paid_at');
            $table->foreign('fine_confirmed_by')->references('id')->on('users')->onDelete('no action');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['fine_confirmed_by']);
            $table->dropColumn(['fine_amount', 'fine_paid', 'fine_paid_at', 'fine_confirmed_by']);
        });
    }
};
