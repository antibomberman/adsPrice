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

            $table->longText('offer_ru')->nullable()->comment('Оферта');
            $table->longText('offer_kz')->nullable()->comment('Оферта');

            $table->longText('privacy_policy_ru')->nullable()->comment('Политика конфиденциальности');
            $table->longText('privacy_policy_kz')->nullable()->comment('Политика конфиденциальности');

            $table->longText('user_agreement_ru')->nullable()->comment('Пользовательское соглашение');
            $table->longText('user_agreement_kz')->nullable()->comment('Пользовательское соглашение');

            $table->longText('help_ru')->nullable()->comment('Помощь');
            $table->longText('help_kz')->nullable()->comment('Помощь');

            $table->longText('about_ru')->nullable();
            $table->longText('about_kz')->nullable();


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
