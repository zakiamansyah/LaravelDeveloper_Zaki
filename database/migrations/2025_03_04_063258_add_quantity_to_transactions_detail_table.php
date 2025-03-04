<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transactions_detail', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->after('transaction_id')->default(0);
        });
    }

    public function down()
    {
        Schema::table('transactions_detail', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
