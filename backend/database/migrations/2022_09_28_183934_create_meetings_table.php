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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->boolean('status')->default(1);
            $table->foreignId('teacher_id');
            $table->foreignId('user_id');
            $table->foreignId('company_id');
            $table->timestamps();
            $table->softDeletes();
        });
        //TODO: Fields that do not match the DBdiagram. (Database/meetings)
        //TODO: Help Wanted. (Database/meetings)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
