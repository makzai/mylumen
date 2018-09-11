<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spreads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corp_id')->comment('企业ID');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->unsignedTinyInteger('type')->comment('1-直接创建，2-做任务，3-引用转发');
            $table->unsignedInteger('matter_id')->comment('必填字段，无论什么type，都指向matters表');
            $table->unsignedInteger('mission_id')->default(0)->comment('type为2时填，都指向missions表');
            $table->unsignedInteger('resource_id')->default(0)->comment('type为3时填，都指向resources表');
            $table->unsignedInteger('seller_id')->default(0)->comment('店员pin_uid');
            $table->string('title', 100)->default('');
            $table->string('image_ids')->default('');
            $table->text('description')->default('')->comment('转发时填的内容');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['corp_id', 'app_id']);
            $table->index('matter_id');
            $table->index('mission_id');
            $table->index('resource_id');
            $table->index('seller_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spreads');
    }
}
