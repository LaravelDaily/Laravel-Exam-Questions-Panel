<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryExamPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_exam', function (Blueprint $table) {
            $table->unsignedInteger('exam_id');
            $table->foreign('exam_id', 'exam_id_fk_1537605')->references('id')->on('exams')->onDelete('cascade');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_1537605')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
