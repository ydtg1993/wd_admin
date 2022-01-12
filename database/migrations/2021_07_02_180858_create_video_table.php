<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('video')) {
            Schema::create('video', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->comment('影片标题');
                $table->string('number')->comment('番号');
                $table->dateTime('date')->comment('影片日期');
                $table->integer('duration')->comment('影片时长');
                $table->string('director')->comment('导演');
                $table->string('producer')->comment('片商');
                $table->string('series')->comment('系列');
                $table->string('publish')->comment('发行');
                $table->string('score')->comment('评分');
                $table->string('category')->comment('类别');
                $table->string('actor')->comment('演员');
                $table->integer('views')->default(0)->comment('访问次数');
                $table->integer('status')->default(0)->comment('影片状态');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
