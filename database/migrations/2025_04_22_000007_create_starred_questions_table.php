<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarredQuestionsTable extends Migration {
    public function up() {
        Schema::create('starred_questions', function (Blueprint $table) {
            $table->id(); // ID bản ghi đánh dấu sao
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người dùng đánh dấu
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Câu hỏi được đánh dấu
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('starred_questions');
    }
}