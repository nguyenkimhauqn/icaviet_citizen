<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerHintsTable extends Migration {
    public function up() {
        Schema::create('answer_hints', function (Blueprint $table) {
            $table->id(); // ID gợi ý
            $table->foreignId('answer_id')->constrained()->onDelete('cascade'); // Gắn với đáp án đúng
            $table->text('content'); // Nội dung gợi ý/xổ xuống khi chọn đúng
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('answer_hints');
    }
}