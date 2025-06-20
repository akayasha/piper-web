<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsocketsTable extends Migration
{
    public function up()
    {
        Schema::create('websockets', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->string('app_key');
            $table->string('app_secret');
            $table->string('app_name');
            $table->string('channel_name');
            $table->string('client_id');
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('websockets');
    }
}
