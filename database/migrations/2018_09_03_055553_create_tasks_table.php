<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corp_id')->comment('企业ID');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->string('name', 100)->default('')->comment('任务名称');
            $table->string('title', 100)->default('');
            $table->unsignedInteger('matter_id')->comment('对应matters表');
            $table->timestamp('begin_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('creator_name', 100)->default('')->comment('创建者名称');
            $table->unsignedInteger('creator_id')->default(0)->comment('创建者uid');
            $table->unsignedTinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['corp_id', 'app_id']);
            $table->index('matter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
