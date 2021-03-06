<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetteVendeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recette_vendeurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("vd_id");
            $table->foreign("vd_id")->references("id")->on("vendeurs");
            $table->date('rc_date');
            $table->double('rc_montant');
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
        Schema::dropIfExists('recette_vendeurs');
    }
}
