<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCountServicesToServiceCategory extends Migration
{
  public function up(){
    Schema::table('service_categories', function (Blueprint $table) {
      $table->integer('count_services')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('service_categories', function (Blueprint $table) {
      $table->dropColumn('count_services');
    });
  }
}
