<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration {
    public function up() {
        Schema::create('topics', function (Blueprint $table) {
            $table->id(); // ID chủ đề
            $table->string('name'); // Tên chủ đề (ví dụ: Government, History...)
            $table->timestamps(); // created_at, updated_at
        });
    }
    public function down() {
        Schema::dropIfExists('topics');
    }
}