<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id')->comment('对应tasks表');
            $table->unsignedInteger('seller_id')->default(0)->comment('店员pin_uid');
            $table->unsignedInteger('spread_id')->comment('对应spreads表');
            $table->softDeletes();
            $table->timestamps();

            $table->index('task_id');
            $table->index('seller_id');
            $table->index('spread_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
