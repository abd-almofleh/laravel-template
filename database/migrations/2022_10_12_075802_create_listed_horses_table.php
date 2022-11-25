<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListedHorsesTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('listed_horses', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->boolean('sex');
      $table->string('race');
      $table->integer('birth_year');
      $table->double('height');
      $table->string('color');
      $table->string('health');
      $table->text('description');
      $table->string('contact_number');
      $table->string('location');
      $table->string('father_name')->nullable();
      $table->string('mother_name')->nullable();
      $table->unsignedBigInteger('type_id');
      $table->unsignedBigInteger('passport_type_id');
      $table->string('meta_title')->nullable();
      $table->text('meta_description')->nullable();
      $table->text('meta_keywords')->nullable();

      $table->foreign('type_id')->references('id')->on('horse_types');
      $table->foreign('passport_type_id')->references('id')->on('horse_passports');

      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('listed_horses');
  }
}
