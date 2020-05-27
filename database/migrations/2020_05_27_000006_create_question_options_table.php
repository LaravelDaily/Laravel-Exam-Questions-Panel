<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option_text');
            $table->boolean('is_correct')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
