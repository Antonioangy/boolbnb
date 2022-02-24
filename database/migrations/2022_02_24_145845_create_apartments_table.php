<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table -> string('title');
            $table -> text('description');
            $table -> tinyInteger('rooms') -> unsigned();
            $table -> tinyInteger('beds') -> unsigned();
            $table -> smallInteger('sq')-> unsigned();
            $table -> string('images') -> nullable();
            $table -> boolean('sponsor') -> default(false);
            $table -> string('latitude');
            $table -> string('longitude');
            $table -> string('address');
            $table -> boolean('deleted') -> default(false);

            $table->bigInteger('user_id') -> unsigned();

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
        Schema::dropIfExists('apartments');
    }
}
