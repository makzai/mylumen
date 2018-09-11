<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corp_id')->comment('企业ID');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->unsignedInteger('pin_uid')->comment('品快用户uid，对应买家');
            $table->unsignedInteger('seller_id')->comment('品快用户uid，对应店员');
            $table->unsignedTinyInteger('gender')->default(0)->comment('买家性别。0-女性，1-男性');
            $table->string('nick_name', 100)->default('')->comment('买家昵称');
            $table->string('name', 20)->default('')->comment('买家姓名');
            $table->string('phone', 20)->default('')->comment('买家电话');
            $table->string('wechat', 100)->default('')->comment('买家微信号');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['corp_id', 'app_id']);
            $table->index('seller_id');
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
        Schema::dropIfExists('customers');
    }
}
