<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('place_id');
            $table->unsignedInteger('performer_id')->nullable();

            $table->foreign('place_id', 'place_fk_360714')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('performer_id', 'performer_fk_360715')->references('id')->on('performers')->onDelete('cascade');
        });
    }
}
