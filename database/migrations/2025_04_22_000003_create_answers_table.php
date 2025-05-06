<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration {
    public function up() {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // ID đáp án
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Câu hỏi liên kết
            $table->text('content'); // Nội dung đáp án
            $table->boolean('is_correct')->default(false); // Có phải đáp án đúng không
            $table->string('audio_path')->nullable(); // File âm thanh nếu có
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('answers');
    }
}