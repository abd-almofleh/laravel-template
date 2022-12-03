<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpVerificationCodesTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('otp_verification_codes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('customer_id');
      $table->string('otp');
      $table->timestamp('expire_at')->nullable();
      $table->timestamps();

      $table->foreign('customer_id')->references('id')->on('customers');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('otp_verification_codes');
  }
}
