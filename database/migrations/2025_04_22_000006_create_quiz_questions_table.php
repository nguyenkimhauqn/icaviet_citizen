<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration {
    public function up() {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id(); // ID câu hỏi trong bài kiểm tra
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade'); // Bài kiểm tra liên kết
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Câu hỏi gốc
            $table->foreignId('user_answer_id')->nullable()->constrained('answers')->onDelete('set null'); // Đáp án người dùng chọn
            $table->boolean('is_correct')->default(false); // Trả lời đúng không
            $table->integer('question_order'); // Thứ tự câu trong bài
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('quiz_questions');
    }
}