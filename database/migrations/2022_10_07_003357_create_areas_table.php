<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();            
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description');
            $table->json('address');
            $table->string('code');
            $table->integer('num_services')->default(0);
            $table->integer('num_followers')->default(0);
            $table->string('categories_included')->nullable();

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
        Schema::dropIfExists('areas');
    }
}
