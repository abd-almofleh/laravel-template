<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RopSexFieldFromListedHorses extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('listed_horses', function (Blueprint $table) {
      $table->dropColumn('sex');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::table('listed_horses', function (Blueprint $table) {
      $table->boolean('sex');
    });
  }
}
