<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceClientTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('device_client', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->unsignedBigInteger('frame_id');
      $table->unsignedBigInteger('device_type_id');
      $table->boolean('status')->default(true);
      $table->unsignedInteger('xaxis');
      $table->unsignedInteger('yaxis');
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
    Schema::dropIfExists('device_client');
  }
}
