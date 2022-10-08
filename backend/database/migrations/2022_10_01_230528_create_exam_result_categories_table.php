<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_result_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('total_questions');
            $table->integer('correct');
            $table->integer('in_correct');
            $table->integer('blank');
            $table->uuid('category_id')->index();
            $table->uuid('exam_id')->index();
            $table->uuid('user_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_result_categories');
    }
};
