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
        Schema::create('task_bloggers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('blogger_id')->constrained('users')->cascadeOnDelete();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('task_bloggers');
    }
};
