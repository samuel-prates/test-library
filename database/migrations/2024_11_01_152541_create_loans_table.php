<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuário que fez o empréstimo
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Livro emprestado
            $table->date('loan_date'); // Data do empréstimo
            $table->date('return_date')->nullable(); // Data de devolução (pode ser nula)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
