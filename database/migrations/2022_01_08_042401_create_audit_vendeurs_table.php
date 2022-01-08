<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditVendeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_vendeurs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('quand');
            $table->string('qui');
            $table->string('quoi');
            $table->float('ancien_salaire');
            $table->float('nouv_salaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_vendeurs');
    }
}
