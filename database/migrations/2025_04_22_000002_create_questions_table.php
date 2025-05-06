<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration {
    public function up() {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // ID câu hỏi
            $table->text('content'); // Nội dung câu hỏi
            $table->string('audio_path')->nullable(); // Đường dẫn file âm thanh của câu hỏi
            $table->foreignId('topic_id')->nullable()->constrained()->onDelete('set null'); // Chủ đề liên kết
            $table->timestamps(); // created_at, updated_at
        });
    }
    public function down() {
        Schema::dropIfExists('questions');
    }
}