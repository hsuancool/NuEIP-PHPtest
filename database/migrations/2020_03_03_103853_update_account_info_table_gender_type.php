<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountInfoTableGenderType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_info', function (Blueprint $table)
        {
            $table->dropColumn('gender');
        });

        Schema::table('account_info', function (Blueprint $table)
        {
            $table->tinyInteger('gender')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_info', function (Blueprint $table)
        {
            $table->string('gender')->after('name')->change();
        });
    }
}
