<?php

use App\Enums\HorseGender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToListedHorses extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('listed_horses', function (Blueprint $table) {
      $table->enum('gender', HorseGender::values())->default(HorseGender::Stallion())->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::table('listed_horses', function (Blueprint $table) {
      $table->dropColumn('gender');
    });
  }
}
