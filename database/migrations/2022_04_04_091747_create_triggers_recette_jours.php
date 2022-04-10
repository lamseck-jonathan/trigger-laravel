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
        END IF");
        DB::unprepared("
        CREATE TRIGGER `add_recette_mois` AFTER INSERT ON `recette_vendeurs`
        FOR EACH ROW IF (SELECT COUNT(*) FROM `recette_mois` WHERE rc_month = MONTH(NEW.rc_date)) = 1
        THEN
        UPDATE `recette_mois` SET rc_montant = rc_montant + NEW.rc_montant WHERE rc_month = MONTH(NEW.rc_date);
        ELSE 
        INSERT INTO `recette_mois` (rc_montant, rc_month,rc_year) VALUES (NEW.rc_montant,MONTH(NEW.rc_date),YEAR(NEW.rc_date));
        END IF");
        DB::unprepared("
        CREATE TRIGGER `ON DELETE RESTRICT` BEFORE DELETE ON `recette_vendeurs`
        FOR EACH ROW IF (SELECT COUNT(*) FROM recette_vendeurs WHERE vd_id = OLD.id) = 1
        THEN
        SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Vendeur existe encore dans Recette Vendeur';
        END IF;
        ");
        DB::unprepared("
        CREATE TRIGGER `update_recette_jours` AFTER UPDATE ON `recette_vendeurs`
        FOR EACH ROW 
        UPDATE `recette_jours` SET rc_montant = rc_montant -OLD.rc_montant +NEW.rc_montant WHERE rc_date = NEW.rc_date;
        ");
        DB::unprepared("
        CREATE TRIGGER `update_recette_mois` AFTER UPDATE ON `recette_vendeurs`
        FOR EACH ROW UPDATE `recette_mois` SET rc_montant = rc_montant -OLD.rc_montant +NEW.rc_montant WHERE rc_month = MONTH(NEW.rc_date)"
        );
        DB::unprepared("
        CREATE TRIGGER `update_recette_jours_after_delete` AFTER DELETE ON `recette_vendeurs`
        FOR EACH ROW UPDATE `recette_jours` SET rc_montant = rc_montant - OLD.rc_montant WHERE rc_date = OLD.rc_date
        ");
        DB::unprepared("
        CREATE TRIGGER `update_recette_mois_after_delete` AFTER DELETE ON `recette_vendeurs`
        FOR EACH ROW UPDATE `recette_mois` SET rc_montant = rc_montant - OLD.rc_montant WHERE rc_month = MONTH(OLD.rc_date);
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
