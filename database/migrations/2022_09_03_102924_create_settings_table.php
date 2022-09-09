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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('balance_phone')->nullable()->comment('телефон номер кассы');
            $table->longText('offer')->nullable()->comment('Оферта');
            $table->longText('privacy_policy')->nullable()->comment('Политика конфиденциальности');
            $table->longText('user_agreement')->nullable()->comment('Пользовательское соглашение');
            $table->longText('help')->nullable()->comment('Помощь');
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
        Schema::dropIfExists('settings');
    }
};
