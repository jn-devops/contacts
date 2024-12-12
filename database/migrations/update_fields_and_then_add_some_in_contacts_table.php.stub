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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('middle_name')->nullable()->change();
            $table->string('civil_status')->nullable()->change();
            $table->string('sex')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->json('aif')->nullable()->after('spouse');
            $table->dropColumn('password');
            $table->dropRememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('middle_name')->change();
            $table->string('civil_status')->change();
            $table->string('sex')->change();
            $table->string('nationality')->change();
            $table->date('date_of_birth')->change();
            $table->dropColumn('aif');
            $table->string('password');
            $table->rememberToken();
        });
    }
};
