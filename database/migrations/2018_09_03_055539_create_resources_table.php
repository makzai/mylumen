<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corp_id')->comment('企业ID');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->unsignedTinyInteger('type')->comment('1-文章，2-海报，3-商品');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
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
            $table->index('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
