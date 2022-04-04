<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggersRecetteJours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER `add_recette_jour_final` AFTER INSERT ON `recette_vendeurs`
 FOR EACH ROW IF (SELECT COUNT(*) FROM `recette_jours` WHERE rc_date = NEW.rc_date) = 1
    THEN
UPDATE `recette_jours` SET rc_montant = rc_montant + NEW.rc_montant WHERE rc_date = NEW.rc_date;
ELSE
INSERT INTO `recette_jours` (rc_date, rc_montant) VALUES (NOW(),NEW.rc_montant);
END IF
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triggers_recette_jours');
    }
}
