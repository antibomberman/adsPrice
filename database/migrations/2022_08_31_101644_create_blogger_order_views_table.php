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
        Schema::create('blogger_order_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blogger_order_id')->constrained('blogger_orders')->cascadeOnDelete();
            $table->ipAddress('ip');
            $table->integer('open_count')->default(0);
            $table->string('agent');
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
        Schema::dropIfExists('blogger_order_views');
    }
};
