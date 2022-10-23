<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorseTypesTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('horse_types', function (Blueprint $table) {
      $table->id();
      $table->string('name_ar');
      $table->string('name_en');
      $table->boolean('status')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('horse_types');
  }
}
