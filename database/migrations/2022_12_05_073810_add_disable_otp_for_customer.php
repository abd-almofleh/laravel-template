<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisableOtpForCustomer extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('customers', function (Blueprint $table) {
      $table->boolean('is_otp_enabled')->default(true)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('customers', function (Blueprint $table) {
      $table->dropColumn('is_otp_enabled');
    });
  }
}
