<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corp_id')->comment('企业ID');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->unsignedInteger('pin_uid')->nullable()->default(null)->comment('品快用户uid');
            $table->unsignedInteger('store_id')->default(0)->comment('对应stores表');
            $table->string('account', 100)->default('')->comment('账号');
            $table->string('name', 100)->default('')->comment('名称');
            $table->string('phone', 20)->default('')->comment('电话号码');
            $table->string('head_img')->nullable()->default(null)->comment('头像');
            $table->string('wechat', 100)->nullable()->default(null)->comment('微信号');
            $table->json('wechat_info')->nullable()->default(null)->comment('微信信息');
            $table->unsignedTinyInteger('role')->default(0)->comment('角色 1,店长 2,店员');
            $table->string('job_title', 100)->nullable()->default(null)->comment('职位名称');
            $table->unsignedTinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['corp_id', 'app_id']);
            $table->index('pin_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
