<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email', 250)->unique();
      $table->string('password');
      $table->string('phone_number');
      $table->rememberToken();
      $table->date('birth_date')->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table->timestamp('email_verified_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('customers');
  }
}
