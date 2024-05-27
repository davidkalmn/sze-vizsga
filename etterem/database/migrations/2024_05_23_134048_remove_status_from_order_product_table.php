<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStatusFromOrderProductTable extends Migration
{
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->string('status')->default('készítés alatt');
        });
    }
}
