<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('id');
            $table->string ('title')->default ('')->comment ('商品名称');
            $table->decimal  ('price',7,2)->default (0)->comment ('商品价格');
            $table->unsignedInteger ('category_id')->index ()->default (0)->comment ('商品属性类型');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->string ('description')->default ('')->comment ('商品描述');
            $table->integer ('total')->default (0)->comment ('商品总价');
            $table->string ('list_pic')->default ('')->comment ('商品列表图');
            $table->string ('pics',255)->default ('')->comment ('商品图册');
            $table->unsignedInteger ('admin_id')->index ()->default (0)->comment ('用户id');
            $table->text ('content')->comment ('商品详情');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
