<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_deadline_and_priority_to_tasks_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeadlineAndPriorityToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->date('deadline')->nullable();
            $table->string('priority')->default('alacsony');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('deadline');
            $table->dropColumn('priority');
        });
    }
}
