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

        if (Schema::hasColumn('users', 'name')) {

            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('name');
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 50)->after('id');
            $table->string('last_name', 50)->after('first_name');
            $table->foreignId('role_id')->after('id')->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
