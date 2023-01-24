<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TodoNotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('owner');
            $table->string('content');
            $table->boolean('complete');
            $table->date('completionTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TodoNotes');
    }
}
