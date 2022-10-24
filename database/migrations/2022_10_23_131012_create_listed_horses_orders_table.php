<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListedHorseOrdersTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('listed_horses_orders', function (Blueprint $table) {
      $table->id();
      $table->enum('status', array_values(config('constants.order_status')))
      ->default(config('constants.order_status.pending'));
      $table->unsignedBigInteger('listed_horse_id')->unique();
      $table->unsignedBigInteger('customer_id');
      $table->timestamps();
      $table->foreign('listed_horse_id')->references('id')->on('listed_horses');
      $table->foreign('customer_id')->references('id')->on('customers');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('listed_horses_orders');
  }
}
