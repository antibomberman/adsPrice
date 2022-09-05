<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment("заказчик")->constrained('users')->cascadeOnDelete();
            $table->integer('status')->default(1);
            $table->foreignId('category_id')->default(1)->constrained('categories')->cascadeOnDelete();
            $table->integer('count')->default(0)->comment('Сколько view нужно');
            $table->float('price')->default(1)->comment('цена за 1 view');
            $table->string('link')->comment('ссылка от заказчика');
            $table->string('video')->nullable()->comment('video path');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
