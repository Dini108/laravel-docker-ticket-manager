<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipFieldsToTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('user_id');

            $table->foreign('event_id', 'event_id_fk_360720')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id', 'user_id_fk_360720')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
