<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* creazione delle foreignkeys per le relazione tra le tabelle */
        Schema::table('apartments', function (Blueprint $table) {

            $table  -> foreign('user_id', 'apartments_users')
                    -> references('id') 
                    -> on('users');
        });

        Schema::table('views', function (Blueprint $table) {

            $table  -> foreign('apartment_id', 'views_apartments')
                    -> references('id') 
                    -> on('apartments');
        });

        Schema::table('messages', function (Blueprint $table) {

            $table  -> foreign('apartment_id', 'messages_apartments')
                    -> references('id') 
                    -> on('apartments');
        });

        Schema::table('apartment_service', function (Blueprint $table) {

            $table  -> foreign('apartment_id', 'apartments_services') 
                    -> references('id') 
                    -> on('apartments');

            $table  -> foreign('service_id', 'services_apartments') 
                    -> references('id') 
                    -> on('services');
        });

        Schema::table('apartment_sponsor', function (Blueprint $table) {

            $table  -> foreign('apartment_id', 'apartments_sponsors') 
                    -> references('id') 
                    -> on('apartments');

            $table  -> foreign('sponsor_id', 'sponsors_apartments') 
                    -> references('id') 
                    -> on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            
            $table-> dropForeign('apartments_users');
        });

        Schema::table('views', function (Blueprint $table) {
            
            $table-> dropForeign('views_apartments');
        });

        Schema::table('messages', function (Blueprint $table) {
            
            $table-> dropForeign('messages_apartments');
        });

        Schema::table('apartment_service', function (Blueprint $table) {

            $table  -> dropForeign('apartments_services');
    
            $table  -> dropForeign('services_apartments');
        });

        Schema::table('apartment_sponsor', function (Blueprint $table) {

            $table  -> dropForeign('apartments_sponsors');
    
            $table  -> dropForeign('sponsors_apartments');
        });
    }
}
