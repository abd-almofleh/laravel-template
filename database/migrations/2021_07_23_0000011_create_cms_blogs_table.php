<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsBlogsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    if (!Schema::hasTable('cms_blogs')) {
      Schema::create('cms_blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title_ar')->nullable();
        $table->string('title_en')->nullable();
        $table->string('slug')->unique()->nullable();
        $table->text('description_ar')->nullable()->nullable();
        $table->text('description_en')->nullable()->nullable();
        $table->foreignId('cms_category_id')->nullable()->constrained()->onDelete('set null');
        $table->boolean('status')->default(0);
        $table->string('meta_title_ar')->nullable();
        $table->string('meta_title_en')->nullable();
        $table->text('meta_description_ar')->nullable();
        $table->text('meta_description_en')->nullable();
        $table->text('meta_keywords_ar')->nullable();
        $table->text('meta_keywords_en')->nullable();
        $table->timestamps();
      });
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('cms_blogs');
  }
}
