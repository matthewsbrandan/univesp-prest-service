<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('order')->unique();
            $table->text('description');
            $table->datetime('scheduled_to')->nullable();
            $table->enum('status',[
                'requested',
                'accepted',
                'canceled_by_applicant',
                'canceled_by_provider',
                'ended'
            ])->default('requested');
            $table->integer('applicant_rating')->nullable(); // AVALIAÇÃO SOBRE O SOLICITANTE
            $table->integer('provider_rating')->nullable(); // AVALIAÇÃO SOBRE O PRESTADOR
            $table->text('applicant_comment')->nullable(); // OPINIÃO DO SOLICITANTE
            $table->text('provider_comment')->nullable(); // OPINIÃO DO PRESTADOR

            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('provider_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('works');
    }
}
