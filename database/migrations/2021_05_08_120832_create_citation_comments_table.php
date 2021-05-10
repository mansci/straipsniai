<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitationCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citation_comments', function (Blueprint $table) {
            $table->id();
            $table->text('text');

            $table->unsignedBigInteger('citation_id');
            $table->timestamps();

            $table->foreign('citation_id')->references('id')->on('citations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citation_comments');
    }
}
