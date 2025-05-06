<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeLogsTable extends Migration {
    public function up() {
        Schema::create('practice_logs', function (Blueprint $table) {
            $table->id(); // ID log luyện tập
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người dùng luyện tập
            $table->dateTime('started_at'); // Bắt đầu luyện tập
            $table->dateTime('finished_at')->nullable(); // Kết thúc (nếu có)
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('practice_logs');
    }
}