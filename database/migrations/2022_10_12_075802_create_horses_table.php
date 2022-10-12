<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorsesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('horses', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->boolean('sex');
      $table->string('bread');
      $table->integer('berth_year');
      $table->double('height');
      $table->double('Weight');
      $table->string('color');
      $table->string('health');
      $table->text('description');
      $table->string('contact_number');
      $table->string('father_name')->nullable();
      $table->string('mother_name')->nullable();
      $table->unsignedBigInteger('type_id');
      $table->unsignedBigInteger('passport_type_id');

      $table->foreign('type_id')->references('id')->on('horse_types');
      $table->foreign('passport_type_id')->references('id')->on('horse_passports');

      $table->softDeletes();
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
    Schema::dropIfExists('horses');
  }
}
