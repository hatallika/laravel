<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('author', 191)->default('Admin');
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'active', 'blocked'])->default('draft');
            $table->string('image', 255)->nullable();
            $table->boolean('display')->default(true); // ошибки не будет, хотя mysql не поддерживает boolean, laravel предложит наиболее подходящмй тип (tinyint integer)
            $table->timestamps();
            //$table->foreignId('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
