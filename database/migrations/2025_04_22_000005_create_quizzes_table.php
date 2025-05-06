<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration {
    public function up() {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); // ID bài kiểm tra
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người thực hiện bài kiểm tra
            $table->integer('total_questions'); // Tổng số câu
            $table->integer('correct_answers')->default(0); // Số câu đúng
            $table->boolean('is_completed')->default(false); // Đã hoàn thành hay chưa
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('quizzes');
    }
}