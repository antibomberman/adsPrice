<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru');
            $table->string('name_kz');
            $table->timestamps();
            $table->softDeletes();

        });
       Category::create(['name' => 'все']);

        Schema::table('users',function (Blueprint $table){
            $table->foreignId('category_id')->default(1)->after('balance')->constrained('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users',function (Blueprint $table){
            $table->dropForeign('users_category_id_foreign');
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('categories');
    }
};
