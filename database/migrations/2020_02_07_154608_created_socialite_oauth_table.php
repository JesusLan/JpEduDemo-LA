<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedSocialiteOauthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite_oauth', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->default(0);
            $table->string("oauth_type", 50);
            $table->string("oauth_id", 50);
            $table->string("provider", 20);
            $table->json("credential")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialite_oauth');
    }
}
