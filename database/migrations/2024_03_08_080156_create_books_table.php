<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('書名');
            $table->string('author')->comment('作者');
            // $table->string('translator')->nullable()->comment('譯者');
            $table->string('category')->comment('書籍類別');
            // $table->string('ISBN')->comment('ISBN');
            // $table->longText('pic')->nullable()->comment('書籍封面');
            $table->integer('book_status')->default(0)->comment('書本狀態(可借閱、不可借閱、遺失)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
