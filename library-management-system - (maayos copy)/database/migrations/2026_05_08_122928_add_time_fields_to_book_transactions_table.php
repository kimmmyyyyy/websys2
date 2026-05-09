<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('book_transactions', function (Blueprint $table) {
            $table->time('borrow_time')->nullable()->after('borrow_date');
            $table->time('return_time')->nullable()->after('return_date');
        });
    }

    public function down(): void
    {
        Schema::table('book_transactions', function (Blueprint $table) {
            $table->dropColumn(['borrow_time', 'return_time']);
        });
    }
};