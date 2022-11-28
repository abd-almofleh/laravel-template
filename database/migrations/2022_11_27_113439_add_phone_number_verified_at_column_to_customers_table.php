<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneNumberVerifiedAtColumnToCustomersTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('customers', function (Blueprint $table) {
      $table->timestamp('phone_verified_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::table('customers', function (Blueprint $table) {
      $table->dropColumn('phone_verified_at');
    });
  }
}
