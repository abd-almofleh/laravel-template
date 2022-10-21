<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('cms_categories', function (Blueprint $table) {
      $table->id();
      $table->string('name_en')->nullable();
      $table->string('name_ar')->nullable();
      $table->boolean('status')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('cms_categories');
  }
}
