<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id');
            $table->integer('to_user_id')->nullable()->comment('if is Privet can not null');
            $table->string('title')->nullable();
            $table->boolean('is_privet')->default(true);
            $table->string('type')->default('text')
                ->comment("type text or video default text");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('room_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('user_id');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('room_id');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_message_delete', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('room');
        Schema::dropIfExists('room_user');
        Schema::dropIfExists('message');
        Schema::dropIfExists('user_message_delete');
    }
}
