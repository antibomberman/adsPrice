<?php

use App\Models\Role;
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Role::create(['id' => 1,'name' => 'блогер']);
        Role::create(['id' => 2,'name' => 'заказчик']);
        Role::create(['id' => 3,'name' => 'админ']);
        Role::create(['id' => 4,'name' => 'модератор']);

        Schema::table('users',function (Blueprint $table){
            $table->foreignId('role_id')->default(1)->after('balance')->constrained('roles')->cascadeOnDelete();
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
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('roles');
    }
};
