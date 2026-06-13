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
        $columns = [];

        if (Schema::hasColumn('members', 'no_identitas')) {
            $columns[] = 'no_identitas';
        }

        if (Schema::hasColumn('members', 'ktp')) {
            $columns[] = 'ktp';
        }

        if ($columns === []) {
            return;
        }

        Schema::table('members', function (Blueprint $table) use ($columns) {
            $table->dropColumn($columns);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (! Schema::hasColumn('members', 'no_identitas')) {
                $table->string('no_identitas')->nullable();
            }

            if (! Schema::hasColumn('members', 'ktp')) {
                $table->string('ktp')->nullable();
            }
        });
    }
};
