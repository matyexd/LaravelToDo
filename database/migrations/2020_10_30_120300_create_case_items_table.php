<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_items', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name');
            $table->text('discription');
            $table->integer('urgency')->default(1);
            $table->boolean('status')->default(False);

            $table->unsignedBigInteger('list_id');
            $table->foreign('list_id')->references('id')->on('todo_lists');
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
        Schema::dropIfExists('case_items');
    }
}
