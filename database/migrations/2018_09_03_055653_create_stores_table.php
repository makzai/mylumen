<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corp_id')->comment('企业ID');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->string('name', 100)->default('')->comment('店名');
            $table->string('province', 20)->default('')->comment('省');
            $table->string('city', 20)->default('')->comment('市');
            $table->string('district', 20)->default('')->comment('区');
            $table->string('detail')->default('');
            $table->string('phone', 100)->default('')->comment('电话号码');
            $table->unsignedTinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['corp_id', 'app_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
