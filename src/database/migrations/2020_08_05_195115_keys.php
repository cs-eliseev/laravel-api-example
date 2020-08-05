<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Keys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
        });
        Schema::table('emails', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropForeign('client_id');
        });
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign('client_id');
        });
    }
}
