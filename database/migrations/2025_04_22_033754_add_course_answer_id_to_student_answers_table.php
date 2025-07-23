<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('student_answers', function (Blueprint $table) {
            $table->foreignId('course_answer_id')->nullable()->constrained('course_answers');
        });
    }
    
    public function down()
    {
        Schema::table('student_answers', function (Blueprint $table) {
            $table->dropForeign(['course_answer_id']);
            $table->dropColumn('course_answer_id');
        });
    }
    
};
