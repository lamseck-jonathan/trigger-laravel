<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVdIdRcVendeur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recette_vendeurs', function (Blueprint $table) {
            $table->unsignedBigInteger("vd_id")->after("id");
            $table->foreign("vd_id")->references("id")->on("vendeurs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recette_vendeurs', function($table) {
            $table->dropForeign(['vd_id_foreign']);
            $table->dropColumn('vd_id');
        });
    }
}
