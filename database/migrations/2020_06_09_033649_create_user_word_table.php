<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_word', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('word_id')->constrained();
            $table->enum('status', [
                'unlearned',
                'learned',
                'shortlisted'
            ]);

            $table->primary([
                'user_id',
                'word_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_word');
    }
}
