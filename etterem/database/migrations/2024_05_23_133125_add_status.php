<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatus extends Migration
{
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->string('status')->default('készítés alatt');
            $table->decimal('total_price', 8, 2);
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('total_price');
        });
    }
}
