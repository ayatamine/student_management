<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCofficientToMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matieres', function (Blueprint $table) {
            $table->double('cofficient')->default(1);
            //here total is the total of module ex 20
            $table->double('total')->default(20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matieres', function (Blueprint $table) {
            //
        });
    }
}
