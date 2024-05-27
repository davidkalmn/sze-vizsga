<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgToPicturesTable extends Migration
{
    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->string('img')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('img');
        });
    }
}
