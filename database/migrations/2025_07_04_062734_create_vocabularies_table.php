<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocabulariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('vocabulary_categories')->onDelete('cascade');
            $table->string('word');               // Ví dụ: Advise
            $table->string('meaning');            // khuyên
            $table->string('hint')->nullable();   // ɐt-vai-(s)
            $table->string('example')->nullable(); // The Cabinet advises the President
            $table->string('audio')->nullable();  // file mp3 hoặc path nếu cần
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vocabularies');
    }
}
